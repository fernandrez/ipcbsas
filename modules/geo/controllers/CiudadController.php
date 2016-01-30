<?php

namespace app\modules\geo\controllers;

use Yii;
use app\modules\geo\models\Ciudad;
use app\modules\geo\models\CiudadSearch;
use app\modules\geo\models\Region;
use app\modules\geo\models\Pais;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * CiudadController implements the CRUD actions for Ciudad model.
 */
class CiudadController extends BasicController
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
     * Lists all Ciudad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CiudadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        $paises=Pais::find()->where(['lower(status)'=>'activo'])->all();
		$paises=ArrayHelper::map($paises,'id','nombre');
		$regiones=Region::find()->where(['status'=>'activa'])->all();
		$regiones=ArrayHelper::map($regiones,'id','nombre');
		asort($paises);asort($regiones);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paises' => $paises,
            'regiones' => $regiones,
            'userCan'=>$this->userCan,
        ]);
    }

    /**
     * Displays a single Ciudad model.
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
     * Creates a new Ciudad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrear()
    {
        $model = new Ciudad();

		$paises=ArrayHelper::map(Pais::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		$regiones=ArrayHelper::map(Region::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		asort($paises);asort($regiones);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'paises' => $paises,
                'regiones' => $regiones,
            ]);
        }
    }

    /**
     * Updates an existing Ciudad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

		$paises=ArrayHelper::map(Pais::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		$regiones=ArrayHelper::map(Region::find()->where(['lower(status)'=>'activo'])->all(),'id','nombre');
		asort($paises);asort($regiones);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'paises' => $paises,
                'regiones' => $regiones,
            ]);
        }
    }

    /**
     * Deletes an existing Ciudad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBorrar($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
    public function actionGetCiudadesRegion($region_id,$empty=true)
    {
    	if($empty){
    		$options=[''=>'Escoge ciudad'];
    	}
        $ciudades=Region::find()->where(['id'=>$region_id])->one()->ciudads;
		$ciudades=ArrayHelper::map($ciudades,'id','nombre');
		asort($ciudades);
		$options+=$ciudades;
		echo Html::renderSelectOptions('',$options);
    }

    /**
     * Finds the Ciudad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ciudad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ciudad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
