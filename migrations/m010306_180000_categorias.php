<?php

use yii\db\Schema;
use yii\db\Migration;

class m010306_180000_categorias extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%cadena}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string(255)->notNull(),
            'pais_origen' => $this->string(1023),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'status' => $this->string()->notNull()->defaultValue('active')
        ], $tableOptions);

        $this->addForeignKey('fk_cadena_created_by','{{%cadena}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk_cadena_updated_by','{{%cadena}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
        
        $this->createTable('{{%almacen}}', [
            'id' => $this->primaryKey(),
            'cadena_id' => $this->integer()->notNull(),
            'identificador' => $this->string(255)->notNull(),
            'latitud' => $this->double(),
            'longitud' => $this->double(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'status' => $this->string()->notNull()->defaultValue('active')
        ], $tableOptions);

        $this->addForeignKey('fk_almacen_cadena','{{%almacen}}','cadena_id','{{%cadena}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk_almacen_created_by','{{%almacen}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk_almacen_updated_by','{{%almacen}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%almacen}}');
        $this->dropTable('{{%cadena}}');
    }
}
