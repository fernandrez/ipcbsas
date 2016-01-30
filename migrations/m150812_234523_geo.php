<?php

use yii\db\Schema;
use yii\db\Migration;

class m150812_234523_geo extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable('{{%direccion_parametro}}', [
            'id' => $this->primaryKey(),
            'tipo' => $this->string(10)->notNull(),
            'codigo' => $this->string(20)->notNull()->unique(),
            'titulo' => $this->string(50)->notNull()->unique(),
            'descripcion' => $this->string()->notNull(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('activo')
        ], $tableOptions);

        $this->addForeignKey('fk_direccion_parametro_created_by','{{%direccion_parametro}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_direccion_parametro_updated_by','{{%direccion_parametro}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
		
		$this->createTable('{{%direccion}}', [
            'id' => $this->primaryKey(),
            'via_id' => $this->integer()->notNull(),
            'numero_via' => $this->string(50)->notNull(),
            'mod_via_id' => $this->integer(),
            'cruce_id' => $this->integer(),
            'numero_cruce' => $this->string(50)->notNull(),
            'mod_cruce_id' => $this->integer(),
            'numero_entrada' => $this->integer()->notNull(),
            'interior_id' => $this->integer(),
            'numero_interior' => $this->integer(),
            'comentario' => $this->string(1024),
            'full' => $this->string(),
            'full_verbose' => $this->string(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('activa')
        ], $tableOptions);
		
		$this->addForeignKey('fk_via','{{%direccion}}','via_id','{{%direccion_parametro}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_cruce','{{%direccion}}','cruce_id','{{%direccion_parametro}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_mod_via','{{%direccion}}','mod_via_id','{{%direccion_parametro}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_mod_cruce','{{%direccion}}','mod_cruce_id','{{%direccion_parametro}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_interior','{{%direccion}}','interior_id','{{%direccion_parametro}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_direccion_created_by','{{%direccion}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_direccion_updated_by','{{%direccion}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
		
        $this->createTable('{{%pais}}', [
            'id' => $this->primaryKey(),
            'pais_cd' => $this->string(5),
            'nombre' => $this->string()->notNull(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('activo')
        ], $tableOptions);
		
		$this->addForeignKey('fk_pais_created_by','{{%pais}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_pais_updated_by','{{%pais}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
		
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'pais_id' => $this->integer()->notNull(),
            'pais_cd' => $this->string(5)->notNull(),
            'region_cd' => $this->string(5)->notNull(),
            'nombre' => $this->string()->notNull(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('activa')
        ], $tableOptions);
        
        $this->addForeignKey('fk_region_pais','{{%region}}','pais_id','{{%pais}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_region_created_by','{{%region}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_region_updated_by','{{%region}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
		
        $this->createTable('{{%ciudad}}', [
            'id' => $this->primaryKey(),
            'pais_id' => $this->integer()->notNull(),
            'pais_cd' => $this->string(5)->notNull(),
            'region_id' => $this->integer()->notNull(),
            'region_cd' => $this->string(5)->notNull(),
            'nombre' => $this->string()->notNull(),
			'created_at' => $this->datetime()->notNull(),
			'updated_at' => $this->datetime(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'status' => $this->string()->notNull()->defaultValue('activa')
        ], $tableOptions);
		
		$this->addForeignKey('fk_ciudad_region','{{%ciudad}}','region_id','{{%region}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_ciudad_pais','{{%ciudad}}','pais_id','{{%pais}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_ciudad_created_by','{{%ciudad}}','created_by','{{%user}}','id','CASCADE','RESTRICT');
		$this->addForeignKey('fk_ciudad_updated_by','{{%ciudad}}','updated_by','{{%user}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%direccion}}');
        $this->dropTable('{{%direccion_parametro}}');
        $this->dropTable('{{%ciudad}}');
        $this->dropTable('{{%region}}');
        $this->dropTable('{{%pais}}');
    }
}
