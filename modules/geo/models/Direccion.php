<?php

namespace app\modules\geo\models;

use Yii;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\components\securitybehaviors\StripTagsBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "direccion".
 *
 * @property integer $id
 * @property integer $via_id
 * @property string $numero_via
 * @property integer $mod_via_id
 * @property integer $cruce_id
 * @property string $numero_cruce
 * @property integer $mod_cruce_id
 * @property integer $numero_entrada
 * @property integer $interior_id
 * @property integer $numero_interior
 * @property string $comentario
 * @property string $full
 * @property string $full_verbose
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $status
 *
 * @property DireccionParametro $cruce
 * @property User $createdBy
 * @property User $updatedBy
 * @property DireccionParametro $interior
 * @property DireccionParametro $modCruce
 * @property DireccionParametro $modVia
 * @property DireccionParametro $via
 * @property PolizaCertificado[] $polizaCertificados
 */
class Direccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'direccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['via_id', 'numero_via', 'numero_cruce', 'numero_entrada'], 'required'],
            [['via_id', 'mod_via_id', 'cruce_id', 'mod_cruce_id', 'numero_entrada', 'interior_id', 'numero_interior', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['numero_via', 'numero_cruce'], 'string', 'max' => 50],
            [['comentario'], 'string', 'max' => 1024],
            [['full', 'full_verbose', 'status'], 'string', 'max' => 255]
        ];
    }
	
	public function behaviors(){
		return [
			'stripTags' => ['class' => StripTagsBehavior::className(),], 
			'timestamp' => [
	            'class' => TimestampBehavior::className(),
	            'attributes' => [
	                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
	                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
	            ],
	            'value' => new Expression('NOW()'),
             ],
			'blameable' => ['class' => BlameableBehavior::className(),],
        ];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'via_id' => Yii::t('app', 'Vía'),
            'numero_via' => Yii::t('app', '# Via'),
            'mod_via_id' => Yii::t('app', 'Mod Vía'),
            'cruce_id' => Yii::t('app', 'Cruce'),
            'numero_cruce' => Yii::t('app', '# Cruce'),
            'mod_cruce_id' => Yii::t('app', 'Mod Cruce'),
            'numero_entrada' => Yii::t('app', '# Entrada'),
            'interior_id' => Yii::t('app', 'Interior'),
            'numero_interior' => Yii::t('app', '# Interior'),
            'comentario' => Yii::t('app', 'Comentario'),
            'full' => Yii::t('app', 'Full'),
            'full_verbose' => Yii::t('app', 'Full Verbose'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCruce()
    {
        return $this->hasOne(DireccionParametro::className(), ['id' => 'cruce_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterior()
    {
        return $this->hasOne(DireccionParametro::className(), ['id' => 'interior_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModCruce()
    {
        return $this->hasOne(DireccionParametro::className(), ['id' => 'mod_cruce_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModVia()
    {
        return $this->hasOne(DireccionParametro::className(), ['id' => 'mod_via_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVia()
    {
        return $this->hasOne(DireccionParametro::className(), ['id' => 'via_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolizaCertificados()
    {
        return $this->hasMany(PolizaCertificado::className(), ['direccion_riesgo_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DireccionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DireccionQuery(get_called_class());
    }
	
    public function beforeSave($insert)
	{
	    if (parent::beforeSave($insert)) {
	        if(is_null($this->cruce_id)){
	        	$this->completarCruce();
	        }
			$this->full=$this->concatenar();
			$this->full_verbose=$this->concatenar(true);
	        return true;
	    } else {
	        return false;
	    }
	}
	
	public function completarCruce(){
		switch(strtolower($this->via->codigo_basico)){
			case 'cl':
				$cr=DireccionParametro::find()->where(['lower(codigo)'=>'kr'])->one();
				break;
			case 'kr':
				$cr=DireccionParametro::find()->where(['lower(codigo)'=>'cl'])->one();
				break;
    	}
		$this->cruce_id=$cr->id;
	}
	
	public function concatenar($verbose=false){
		$ret=$this->via->codigo.' '.$this->numero_via;
		if($verbose)
			$ret=$this->via->titulo.' '.$this->numero_via;
		if($this->mod_via_id) $ret.=$this->modVia->titulo;
		$ret.=' # '.$this->numero_cruce;
		if($this->mod_cruce_id) $ret.=$this->modCruce->titulo;
		$ret.=' - '.$this->numero_entrada;
		if($this->interior_id) $ret.=', '.$this->interior->titulo;
		if($this->numero_interior) $ret.=' '.$this->numero_interior;
		if($this->comentario && $verbose) $ret.=' / '.$this->comentario;
		return $ret;
	}
	
	public static function calcularDistanciaCuadras($direccionRiesgoProgramar,$direccionRiesgoProgramado){
		$calles=0;$carreras=0;
		switch(strtolower($direccionRiesgoProgramado->via->codigo_basico)){
			case 'cl':
				switch(strtolower($direccionRiesgoProgramar->via->codigo_basico)){
					case 'cl':
						$calles=abs($direccionRiesgoProgramado->numero_via-$direccionRiesgoProgramar->numero_via);
						$carreras=abs($direccionRiesgoProgramado->numero_cruce-$direccionRiesgoProgramar->numero_cruce);
						break;
					case 'kr':
						$calles=abs($direccionRiesgoProgramado->numero_via-$direccionRiesgoProgramar->numero_cruce);
						$carreras=abs($direccionRiesgoProgramado->numero_cruce-$direccionRiesgoProgramar->numero_via);
						break;
				}
				break;
			case 'kr':
				switch(strtolower($direccionRiesgoProgramar->via->codigo_basico)){
					case 'cl':
						$calles=abs($direccionRiesgoProgramado->numero_cruce-$direccionRiesgoProgramar->numero_via);
						$carreras=abs($direccionRiesgoProgramado->numero_via-$direccionRiesgoProgramar->numero_cruce);
						break;
					case 'kr':
						$calles=abs($direccionRiesgoProgramado->numero_cruce-$direccionRiesgoProgramar->numero_cruce);
						$carreras=abs($direccionRiesgoProgramado->numero_via-$direccionRiesgoProgramar->numero_via);
						break;
				}
				break;
		}
		return $calles+$carreras;
	}
}
