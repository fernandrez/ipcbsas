<?php

namespace app\modules\geo\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use app\components\securitybehaviors\StripTagsBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "direccion_parametro".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $codigo
 * @property string $titulo
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $status
 *
 * @property Direccion[] $direccions
 * @property Direccion[] $direccions0
 * @property Direccion[] $direccions1
 * @property Direccion[] $direccions2
 * @property User $createdBy
 * @property User $updatedBy
 * @property Zona[] $zonas
 * @property Zona[] $zonas0
 * @property Zona[] $zonas1
 * @property Zona[] $zonas2
 */
class DireccionParametro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'direccion_parametro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'codigo', 'titulo', 'descripcion'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['tipo'], 'string', 'max' => 10],
            [['codigo'], 'string', 'max' => 20],
            [['titulo'], 'string', 'max' => 50],
            [['descripcion', 'status'], 'string', 'max' => 255],
            [['codigo'], 'unique'],
            [['titulo'], 'unique']
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
            'id' => 'ID',
            'tipo' => 'Tipo',
            'codigo' => 'Codigo',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }

	public function getCodigo_basico(){
		switch(strtolower($this->codigo)){
			case 'cl':
			case 'dg':
				return 'cl';
			case 'k':
			case 'kr':
			case 'tr':
				return 'kr';
    	}
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions()
    {
        return $this->hasMany(Direccion::className(), ['interior_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions0()
    {
        return $this->hasMany(Direccion::className(), ['mod_cruce_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions1()
    {
        return $this->hasMany(Direccion::className(), ['mod_via_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccions2()
    {
        return $this->hasMany(Direccion::className(), ['via_id' => 'id']);
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
    public function getZonas()
    {
        return $this->hasMany(Zona::className(), ['via_b_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonas0()
    {
        return $this->hasMany(Zona::className(), ['via_l_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonas1()
    {
        return $this->hasMany(Zona::className(), ['via_r_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonas2()
    {
        return $this->hasMany(Zona::className(), ['via_t_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DireccionParametroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DireccionParametroQuery(get_called_class());
    }
}
