<?php
namespace app\components\functionalbehaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use app\models\eavadj\EavEntity;

class EntidadBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'crearEntidad',
        ];
    }
	
	public function crearEntidad(){
		$m=new EavEntity;
		$m->entityModel=basename(str_replace('\\', '/', get_class($this->owner)));;
		$m->save();
		$this->owner->id=$m->id;
	}
}
?>