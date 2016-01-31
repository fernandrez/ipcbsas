<?php

namespace app\modules\registro\controllers;

use Yii;
use yii\web\Controller;
use app\modules\registro\models\Registro;
use app\modules\registro\models\RegistroSearch;

/**
 * Default controller for the `registro` module
 */
class DefaultController extends \app\controllers\BasicController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$new = new Registro();
		$searchModel = new RegistroSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);
		
		if($new->load(Yii::$app->request->post())){
			$new->save();	
		}
		
        return $this->render('index',[
        	'new' => $new,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
