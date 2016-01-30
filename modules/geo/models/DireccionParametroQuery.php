<?php

namespace app\modules\geo\models;

/**
 * This is the ActiveQuery class for [[DireccionParametro]].
 *
 * @see DireccionParametro
 */
class DireccionParametroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DireccionParametro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DireccionParametro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}