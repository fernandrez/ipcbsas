<?php

namespace app\modules\parametros\models;

use Yii;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\components\securitybehaviors\StripTagsBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;
use yii\base\InvalidParamException;

/**
 * This is the model class for table "parametro".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $valor
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property string $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Parametro extends \yii\db\ActiveRecord
{
	const ACTIVO="activo";
	const INACTIVO="inactivo";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'valor', 'fecha_inicio'], 'required'],
            [['fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
            [['created_by'], 'integer'],
            [['nombre', 'status'], 'string', 'max' => 255],
            [['valor'], 'string', 'max' => 1200],
            [['valor'], 'validarJson']
        ];
    }
	
	public function validarJson($attribute, $params){
		try{Json::decode($this->{$attribute});}
		catch(InvalidParamException $ex){
			$this->addError($attribute,$ex->getMessage());
		}
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
			'blameable' => ['class' => BlameableBehavior::className(),'updatedByAttribute' => null,],
        ];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'valor' => Yii::t('app', 'Valor'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     * @return ParametroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParametroQuery(get_called_class());
    }
}
