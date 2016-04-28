<?php

use yii\db\Schema;
use yii\db\Migration;

class m160427_220000_orderbook extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%orderbook}}', [
            'id' => $this->primaryKey(),
            'timestamp' => $this->bigInteger()->notNull(),
            'bids' => $this->string(10240)->notNull(),
            'asks' => $this->string(10240)->notNull(),
            'pair' => $this->string(255)->notNull(),
			'created_at' => $this->datetime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%orderbook}}');
    }
}
