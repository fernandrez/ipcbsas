<?php
namespace app\components\functionalbehaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use app\models\eavadj\EavEntity;

class FechaHoraBehavior extends Behavior
{
	public $_fecha, $_hora, $_minuto;
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getFecha_hora',
        ];
    }

	public function getFecha_hora(){
		if($this->owner->fecha){
			$this->owner->fecha_hora=$this->owner->fecha.' '.$this->owner->hora.':'.$this->owner->minuto.':00';
			return $this->owner->fecha_hora;
		}
		if($this->owner->fecha_hora){
			$this->_fecha=substr($this->owner->fecha_hora, 0,10);
			$this->_hora=substr($this->owner->fecha_hora, 11,2);
			$this->_minuto=substr($this->owner->fecha_hora, 14,2);
			return $this->owner->fecha_hora;
		}
		return null;
	}

	public function getFecha(){
		if($this->_fecha){
			return $this->_fecha;
		}
		if($this->owner->fecha_hora){
			$this->_fecha=substr($this->owner->fecha_hora, 0,10);
			return $this->_fecha;
		}
		return null;
	}

	public function getHora(){
		if($this->_hora){
			return $this->_hora;
		}
		if($this->owner->fecha_hora){
			$this->_hora=substr($this->owner->fecha_hora, 11,2);
			return $this->_hora;
		}
		return null;
	}

	public function getMinuto(){
		if($this->_minuto){
			return $this->_minuto;
		}
		if($this->owner->fecha_hora){
			$this->_minuto=substr($this->owner->fecha_hora, 14,2);
			return $this->_minuto;
		}
		return null;
	}
	
	public function setFecha($_fecha){
		$this->_fecha=$_fecha;
	}
	
	public function setHora($_hora){
		$this->_hora=$_hora;
	}
	
	public function setMinuto($_minuto){
		$this->_minuto=$_minuto;
	}
}
?>