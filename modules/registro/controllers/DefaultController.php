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
	
    public function actionChart($id)
    {
    	$reg = $this->findModel($id);
		$searchModel = new RegistroSearch();
		//Get paginanted models for grid
        $dataProvider = $searchModel->search([
        	'RegistroSearch' => [
	        		'categoria'=>$reg->categoria,
	        		'elemento'=>$reg->elemento,
	        		'descripcion'=>$reg->descripcion
        		]
        	]);
		
		//Get all models for chart (no pagination)
		$dataProviderClone = clone $dataProvider; $dataProviderClone->pagination = false; $allModels = $dataProviderClone->models;
		foreach($allModels as $m){
			$series[$m->almacen]['x'][]=$m->fecha;
			$series[$m->almacen]['y'][]=$m->precio_unitario;
		}
		
        return $this->render('chart',[
            'reg' => $reg,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Registro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
