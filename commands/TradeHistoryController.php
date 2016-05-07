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
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        //Pide la ultima de todas
        $curl = new curl\Curl();
        $response = json_decode($curl->get('https://cex.io/api/trade_history/BTC/USD/'),true);
        $lastCex = $response[0]['tid'];
        $lastSaved = -1;
        do{
            if($lastSaved == -1){
                $lastModel = Trades::find()->orderBy('tid DESC')->one();
                if($lastModel){
                    $since = $last->tid + 1;
                } else {
                    $since = 1;
                }
            } else {
                $since = $lastSaved + 1;
            }
            $response = json_decode($curl->get('https://cex.io/api/trade_history/BTC/USD/?since='.$since),true);
            $index = count($response);
            if($response[999]['tid'] < $since){
                $index = 999 - ($since - $response[999]['tid']);
            }
            while($index){
                $trade = $response[--$index];
                $tradeModel = new Trades;
                $tradeModel->type = $trade['type'];
                $tradeModel->date = $trade['date'];
                $tradeModel->amount = $trade['amount'];
                $tradeModel->price = $trade['price'];
                $tradeModel->tid = $trade['tid'];
                if($tradeModel->save() && $tradeModel->tid > $lastSaved){
                    $lastSaved = $tradeModel->tid;
                }
            }
        }while($lastSaved < $lastCex);
    }
}
