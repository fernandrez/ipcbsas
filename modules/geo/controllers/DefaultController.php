<?php

namespace app\modules\geo\controllers;

use yii\web\Controller;

class DefaultController extends \app\controllers\BasicController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
