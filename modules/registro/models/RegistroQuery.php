<?php

namespace app\modules\registro\models;

/**
 * This is the ActiveQuery class for [[Registro]].
 *
 * @see Registro
 */
class RegistroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Registro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Registro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}