<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use linslin\yii2\curl;
use app\models\Trades;
use yii\db\Query;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TradeHistoryController extends Controller
{
    private static $ticks = ['ETH/BTC','ETH/USD','BTC/USD',];
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        foreach(self::$ticks as $tick){
            //Pide la ultima de todas
            $curl = new curl\Curl();
            $response = json_decode($curl->get('https://cex.io/api/trade_history/'.$tick),true);
            $lastCex = $response[0]['tid'];
            $lastSaved = -1;
            do{
                if($lastSaved == -1){
                    $lastTid = new Query;
                    $lastTid = $lastTid->select('max(tid) as tid')->from('trades')->where(['tick'=>$tick])->one();
                    $lastTid = $lastTid['tid'];
                    if(!is_null($lastTid)){
                        $since = $lastTid + 1;
                    } else {
                        $since = 1;
                    }
                } else {
                    $since = $lastSaved + 1;
                }
                $response = json_decode($curl->get('https://cex.io/api/trade_history/'.$tick.'/?since='.$since),true);
                $index = count($response);
                $nine = $index - 1;
                echo 'Since:'.$since.', Res:'.$response[$nine]['tid'].'\r\n'  ;
                if($response[$nine]['tid'] < $since){
                    if($since - $response[$nine]['tid'] < 1000){
                        $index = $nine - ($since - $response[$nine]['tid']);
                    } else {
                        $since += $since - $response[$nine]['tid'];
                        $response = json_decode($curl->get('https://cex.io/api/trade_history/'.$tick.'/?since='.$since),true);
                    }
                }
                while($index){
                    $trade = $response[--$index];
                    $tradeModel = new Trades;
                    $tradeModel->tick = $tick;
                    $tradeModel->type = $trade['type'];
                    $tradeModel->date = $trade['date'];
                    $tradeModel->amount = $trade['amount'];
                    $tradeModel->price = $trade['price'];
                    $tradeModel->tid = $trade['tid'];
                    if($tradeModel->save() && $tradeModel->tid > $lastSaved){
                        $lastSaved = $tradeModel->tid;
                    } else {
                        var_dump($tradeModel->errors);
                    }
                    unset($tradeModel);
                }
            }while($lastSaved < $lastCex);
        }
    }
}
