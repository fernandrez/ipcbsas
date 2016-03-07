<?php

use yii\db\Schema;
use yii\db\Migration;

class m010306_180010_almacenes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%categoria}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(255)->notNull(),
            'descripcion' => $this->string(255),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('active')
        ], $tableOptions);

        $this->addForeignKey('fk_categoria_created_by','{{%categoria}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_categoria_updated_by','{{%categoria}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%categoria}}');
    }
}
