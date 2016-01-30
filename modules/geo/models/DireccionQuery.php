<?php

namespace app\modules\geo\models;

/**
 * This is the ActiveQuery class for [[Direccion]].
 *
 * @see Direccion
 */
class DireccionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Direccion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Direccion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}