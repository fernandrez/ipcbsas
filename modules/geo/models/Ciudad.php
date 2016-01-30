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
 * This is the model class for table "ciudad".
 *
 * @property integer $id
 * @property integer $pais_id
 * @property string $pais_cd
 * @property integer $region_id
 * @property string $region_cd
 * @property string $nombre
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $status
 *
 * @property User $createdBy
 * @property Pais $pais
 * @property Region $region
 * @property User $updatedBy
 * @property FirmaIngeniero[] $firmaIngenieros
 * @property PolizaCertificado[] $polizaCertificados
 * @property Visita[] $visitas
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pais_id', 'pais_cd', 'region_id', 'region_cd', 'nombre'], 'required'],
            [['pais_id', 'region_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['pais_cd', 'region_cd'], 'string', 'max' => 5],
            [['nombre', 'status'], 'string', 'max' => 255]
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
            'pais_id' => Yii::t('app', 'Pais ID'),
            'pais_cd' => Yii::t('app', 'Pais Cd'),
            'region_id' => Yii::t('app', 'Region ID'),
            'region_cd' => Yii::t('app', 'Region Cd'),
            'nombre' => Yii::t('app', 'Nombre'),
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'pais_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
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
    public function getFirmaIngenieros()
    {
        return $this->hasMany(FirmaIngeniero::className(), ['ciudad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolizaCertificados()
    {
        return $this->hasMany(PolizaCertificado::className(), ['ciudad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitas()
    {
        return $this->hasMany(Visita::className(), ['ciudad_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CiudadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CiudadQuery(get_called_class());
    }
	
    public function beforeValidate()
	{
	    if (parent::beforeValidate()) {
		    if(!($this->pais_cd)){
		    	if(isset($this->pais)){
		    		$this->pais_cd=$this->pais->pais_cd;
				}
		    }
		    if(!($this->region_cd)){
		    	if(isset($this->region)){
		    		$this->region_cd=$this->region->region_cd;
				}
		    }
	        return true;
	    } else {
	        return false;
	    }
	}
}
