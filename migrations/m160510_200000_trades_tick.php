<?php

use yii\db\Schema;
use yii\db\Migration;

class m160510_200000_trades_tick extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		
        $this->addColumn('{{%trades}}','tick','string');
        $command = \Yii::$app->db->createCommand();
        $command->update('{{%trades}}',['tick' => 'BTC/USD'],'tick is null')->execute();
        $this->addColumn('{{%orderbook}}','tick','string');
        $command = \Yii::$app->db->createCommand();
        $command->update('{{%orderbook}}',['tick' => 'BTC/USD'],'tick is null')->execute();
    }

    public function down()
    {
        $this->dropColumn('{{%trades}}','tick');
        $this->dropColumn('{{%orderbook}}','tick');
    }
}
