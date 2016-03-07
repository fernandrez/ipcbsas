<?php

use yii\db\Schema;
use yii\db\Migration;

class m010306_190000_regcatalm extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->addColumn('{{%registro}}','cadena_id','integer');
        $this->addColumn('{{%registro}}','almacen_id','integer');
        $this->addColumn('{{%registro}}','categoria_id','integer');

        $this->addForeignKey('fk_registro_cadena','{{%registro}}','cadena_id','{{%cadena}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk_registro_almacen','{{%registro}}','almacen_id','{{%almacen}}','id','CASCADE','RESTRICT');
        $this->addForeignKey('fk_registro_categoria','{{%registro}}','categoria_id','{{%categoria}}','id','CASCADE','RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_registro_cadena','{{%registro}}');
        $this->dropForeignKey('fk_registro_almacen','{{%registro}}');
        $this->dropForeignKey('fk_registro_categoria','{{%registro}}');
        
        $this->dropColumn('{{%registro}}','cadena_id');
        $this->dropColumn('{{%registro}}','almacen_id');
        $this->dropColumn('{{%registro}}','categoria_id');
    }
}
