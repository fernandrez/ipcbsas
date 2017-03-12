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
class Import extends \app\modules\registro\models\Registro
{
  
}
