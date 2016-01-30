<?php

namespace app\modules\registro\models;

use Yii;
use dektrium\user\models\User;
use app\components\securitybehaviors\StripTagsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "registro".
 *
 * @property integer $id
 * @property string $almacen
 * @property string $categoria
 * @property string $elemento
 * @property string $marca
 * @property string $descripcion
 * @property string $fecha
 * @property double $cantidad
 * @property string $unidad
 * @property double $precio
 * @property double $precio_unitario
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Registro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['almacen', 'categoria', 'elemento', 'fecha', 'cantidad', 'unidad', 'precio', 'precio_unitario'], 'required'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['cantidad', 'precio', 'precio_unitario'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['almacen', 'categoria', 'elemento', 'marca', 'descripcion', 'status'], 'string', 'max' => 255],
            [['unidad'], 'string', 'max' => 25],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']]
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
            'almacen' => 'Almacen',
            'categoria' => 'Categoria',
            'elemento' => 'Elemento',
            'marca' => 'Marca',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'cantidad' => 'Cantidad',
            'unidad' => 'Unidad',
            'precio' => 'Precio',
            'precio_unitario' => 'Precio Unitario',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'status' => 'Status',
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @inheritdoc
     * @return RegistroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistroQuery(get_called_class());
    }
}
