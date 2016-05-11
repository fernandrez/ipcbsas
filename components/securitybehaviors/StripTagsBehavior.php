<?php
namespace app\components\securitybehaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;

class StripTagsBehavior extends Behavior
{
    public function events()
    {
        return [
            //ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'stripTags',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'stripTags',
            ActiveRecord::EVENT_AFTER_FIND => 'stripTags',
        ];
    }
	
	public function stripTags(){
		foreach($this->owner->attributes as $attribute=>$value){
			if(!is_null($this->owner->{$attribute}) && $attribute!='path_icono' && $attribute!='tick'){
				$this->owner->{$attribute}=str_replace('\\', '',
											str_replace('/', '',
											str_replace('http:', '',
											str_replace('https:', '', 
											str_replace('..', '', strip_tags($value))))));
			}
		}
	}
}
?>