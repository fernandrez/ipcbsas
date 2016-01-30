<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_230000_reg extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%registro}}', [
            'id' => $this->primaryKey(),
            'almacen' => $this->string(255)->notNull(),
            'categoria' => $this->string(255)->notNull(),
            'elemento' => $this->string(255)->notNull(),
            'marca' => $this->string(255),
            'descripcion' => $this->string(255),
			'fecha' => $this->date()->notNull(),
            'cantidad' => $this->double()->notNull(),
            'unidad' => $this->string(25)->notNull(),
            'precio' => $this->double()->notNull(),
            'precio_unitario' => $this->double()->notNull(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'order' => $this->string()->notNull(),
			'status' => $this->string()->notNull()->defaultValue('active')
        ], $tableOptions);

        $this->addForeignKey('fk_registro_created_by','{{%registro}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_registro_parametro_updated_by','{{%registro}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%registro}}');
    }
}
