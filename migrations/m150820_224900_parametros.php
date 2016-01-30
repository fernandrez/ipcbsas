<?php

use yii\db\Schema;
use yii\db\Migration;

class m150820_224900_parametros extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parametro}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'valor' => $this->string(1200)->notNull(),
            'fecha_inicio' => $this->datetime()->notNull(),
            'fecha_fin' => $this->datetime(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'status' => $this->string()->notNull()->defaultValue('activo')
        ], $tableOptions);
		
		$this->addForeignKey('fk_parametro_created_by','{{%parametro}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%parametro}}');
    }
}
