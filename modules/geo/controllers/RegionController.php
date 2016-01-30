<?php

namespace app\modules\geo\controllers;

use Yii;
use app\modules\geo\models\Region;
use app\modules\geo\models\RegionSearch;
use app\modules\geo\models\Pais;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends BasicController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        $paises=Pais::find()->where(['lower(status)'=>'activo'])->all();
		$paises=ArrayHelper::map($paises,'id','nombre');
		asort($paises);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paises' => $paises,
            'userCan'=>$this->userCan,
        ]);
    }

    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionVer($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'userCan'=>$this->userCan,
        ]);
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrear()
    {
        $model = new Region();
		
		$paises=ArrayHelper::map(Pais::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		asort($paises);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'paises' => $paises,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);
		
		$paises=ArrayHelper::map(Pais::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		asort($paises);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'paises' => $paises,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBorrar($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
    public function actionGetRegionesPais($pais_id,$empty=true)
    {
    	if($empty){
    		$options=[''=>'Escoge región'];
    	}
        $regiones=Pais::find()->where(['id'=>$pais_id])->one()->regions;
		$regiones=ArrayHelper::map($regiones,'id','nombre');
		asort($regiones);
		$options+=$regiones;
		echo Html::renderSelectOptions('',$options);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
