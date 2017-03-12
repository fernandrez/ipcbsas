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
 * This is the model class for table "orderbook".
 *
 * @property integer $id
 * @property integer $timestamp
 * @property string $bids
 * @property string $asks
 * @property string $pair
 * @property string $created_at
 */
class Orderbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp', 'bids', 'asks', 'pair'], 'required'],
            [['timestamp'], 'integer'],
            [['pair'], 'string', 'max' => 255],
            [['bids', 'asks'], 'string', 'max' => 10240]
        ];
    }
	
	public function behaviors(){
		return [
			'timestamp' => [
	            'class' => TimestampBehavior::className(),
	            'attributes' => [
	                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
	            ],
	            'value' => new Expression('NOW()'),
             ],
        ];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'bids' => Yii::t('app', 'Bids'),
            'asks' => Yii::t('app', 'Asks'),
            'pair' => Yii::t('app', 'Pair'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
