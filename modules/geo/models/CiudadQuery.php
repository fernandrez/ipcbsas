<?php

namespace app\modules\geo\models;

/**
 * This is the ActiveQuery class for [[Ciudad]].
 *
 * @see Ciudad
 */
class CiudadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Ciudad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ciudad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}