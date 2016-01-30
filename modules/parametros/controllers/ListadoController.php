<?php

namespace app\modules\parametros\controllers;

use Yii;
use app\modules\parametros\models\Parametro;
use app\modules\parametros\models\ParametroSearch;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ParametroController implements the CRUD actions for Parametro model.
 */
class ListadoController extends BasicController
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
     * Lists all Parametro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParametroSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parametro model.
     * @param integer $id
     * @return mixed
     */
    public function actionVer($id)
    {
        return $this->render('ver', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Parametro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCrear()
    {
        $model = new Parametro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ver', 'id' => $model->id]);
        } else {
            return $this->render('crear', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Parametro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);
        $new=new Parametro();
		$new->setAttributes(['nombre'=>$model->nombre,'valor'=>$model->valor]);
        if ($new->load(Yii::$app->request->post())) {
			$new->fecha_inicio=date('Y-m-d H:i:s');
			$model->fecha_fin=date('Y-m-d H:i:s');
			$model->status=Parametro::INACTIVO;
			if($new->validate()){	
				$model->save();
				$new->save();
	            return $this->redirect(['ver', 'id' => $new->id]);
			}
        }
        return $this->render('editar', [
        	'id'=>$model->id,
            'model' => $new,
        ]);
    }

    /**
     * Deletes an existing Parametro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBorrar($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Parametro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parametro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parametro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
