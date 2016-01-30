<?php

namespace app\modules\parametros\models;

use yii\helpers\Json;

/**
 * This is the ActiveQuery class for [[Parametro]].
 *
 * @see Parametro
 */
class ParametroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Parametro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Parametro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return Parametro|array|null
     */
    public function activeByName($name, $db = null)
    {
    	$ret=parent::where(['nombre'=>$name])->andWhere('fecha_fin is null')->one();
		if(!$ret)return null;
        return $ret->valor;
    }

    /**
     * @inheritdoc
     * @return Parametro|array|null
     */
    public function activeByNameDecoded($name, $db = null)
    {
    	$ret=parent::where(['nombre'=>$name])->andWhere('fecha_fin is null')->one();
		if(!$ret)return null;
        return Json::decode($ret->valor);
    }
}