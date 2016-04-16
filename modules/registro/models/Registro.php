<?php

namespace app\modules\registro\models;

use Yii;
use dektrium\user\models\User;
use app\modules\registro\models\Cadena;
use app\modules\registro\models\Almacen;
use app\modules\registro\models\Categoria;
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
            [['elemento', 'fecha', 'cantidad', 'unidad', 'precio', 'categoria_id', 'cadena_id', 'almacen_id'], 'required'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['cadena_id', 'almacen_id', 'categoria_id', 'cantidad', 'precio', 'precio_unitario'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['almacen', 'categoria', 'elemento', 'marca', 'descripcion', 'status'], 'string', 'max' => 255],
            [['unidad'], 'string', 'max' => 25],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['cadena_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cadena::className(), 'targetAttribute' => ['cadena_id' => 'id']],
            [['almacen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Almacen::className(), 'targetAttribute' => ['almacen_id' => 'id']],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']]
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
     * @return \yii\db\ActiveQuery
     */
    public function getCadenaR()
    {
        return $this->hasOne(Cadena::className(), ['id' => 'cadena_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacenR()
    {
        return $this->hasOne(Almacen::className(), ['id' => 'almacen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaR()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }

    /**
     * @inheritdoc
     * @return RegistroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistroQuery(get_called_class());
    }
	
    public function beforeSave($insert)
	{
	    if (parent::beforeSave($insert)) {
	    	$this->precio_unitario = $this->precio / $this->cantidad;
			if(!$this->fecha){
				$this->fecha = date('Y-m-d');
			}
			if($insert){
				$old = Registro::find()->where([
					'almacen_id' => $this->almacen_id,
					'categoria_id' => $this->categoria_id,
					'elemento' => $this->elemento,
					'marca' => $this->marca,
					'descripcion' => $this->descripcion,
				])
				->all();
				if(is_array($old) && count($old) > 0){
					$maxFecha = $old[0]->fecha;
					foreach($old as $o){
						if($o->fecha > $maxFecha){
							$maxFecha = $o->fecha;
						}
						if($o->fecha < $this->fecha){
							$o->status = 'inactive';
							$o->save();
						}
					}
					if($maxFecha > $this->fecha){
						$this->status = 'inactive';
					}
				}
                $this->almacen = $this->cadenaR->titulo.' '.$this->almacenR->identificador;
                $this->categoria = $this->categoriaR->titulo;
			}
	        return true;
	    } else {
	        return false;
	    }
	}
}
