<?php

namespace app\models;

use Yii;
use dektrium\user\models\User;
use app\components\securitybehaviors\StripTagsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "trades".
 *
 * @property integer $id
 * @property string $type
 * @property integer $date
 * @property double $amount
 * @property double $price
 * @property integer $tid
 * @property string $created_at
 */
class Trades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'date', 'amount', 'price', 'tid'], 'required'],
            [['date', 'tid'], 'integer'],
            [['amount', 'price'], 'number'],
            [['tid'], 'unique'],
            [['created_at'], 'safe'],
            [['type'], 'string', 'max' => 255]
        ];
    }
	
	public function behaviors(){
		return [
			'stripTags' => ['class' => StripTagsBehavior::className(),],
			'timestamp' => [
	            'class' => TimestampBehavior::className(),
	            'attributes' => [
	                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
	                //ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
	            ],
	            'value' => new Expression('NOW()'),
             ],
			//'blameable' => ['class' => BlameableBehavior::className(),],
        ];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'date' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'price' => Yii::t('app', 'Price'),
            'tid' => Yii::t('app', 'Tid'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return TradesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TradesQuery(get_called_class());
    }
}
