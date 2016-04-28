<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use linslin\yii2\curl;
use app\models\Orderbook;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class OrderbookController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $curl = new curl\Curl();
 
        //get http://example.com/
        $response = json_decode($curl->get('https://cex.io/api/order_book/BTC/USD/?depth=10'),true);
        $orderbook = new Orderbook;
        $orderbook->id = $response['id'];
        $orderbook->timestamp = $response['timestamp'];
        $orderbook->bids = json_encode($response['bids']);
        $orderbook->asks = json_encode($response['asks']);
        $orderbook->pair = $response['pair'];
        $orderbook->save(); var_dump($orderbook->errors);
    }
}
