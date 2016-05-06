<?php

use yii\db\Schema;
use yii\db\Migration;

class m160506_200000_trades extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%trades}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'date' => $this->bigInteger()->notNull(),
            'amount' => $this->double()->notNull(),
            'price' => $this->double()->notNull(),
            'tid' => $this->bigInteger()->notNull(),
			'created_at' => $this->datetime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%trades}}');
    }
}
