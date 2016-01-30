<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;

/**
 * VisitasController
 */
class BasicController extends Controller
{
	protected $acciones; 
	public $userCan;
	public $activeModule;
	public function beforeAction($action)
	{
    	$this->loadActions();
		$this->loadUserCan();
	    if (!parent::beforeAction($action)) {
	        return false;
	    }
		$route=Yii::$app->controller->route;
	 	$this->activeModule=explode('/',$route)[0];
	    $operacion = str_replace("/", "-", $route);
		//var_dump($operacion);die;
		
		if(\Yii::$app->user->isGuest){
			\Yii::$app->user->returnUrl='/'.$route;
			$this->redirect(['/user/login']);
		}
		
		if(!\Yii::$app->user->can($operacion)){
			throw new ForbiddenHttpException('No estás autorizado');
		}
	 
	    return true;
	}
	
	protected function loadActions(){
		$this->acciones=array_filter(get_class_methods($this),[$this, 'accion']);
		foreach($this->acciones as $k=>$accion){
			$this->acciones[$k]=substr(strtolower(preg_replace('/([A-Z])/', '-$1', str_replace('action', '', $accion))),1);
		}
	}
	
	protected function loadUserCan(){
		$controller=\Yii::$app->controller->id;
		foreach($this->acciones as $accion){
			$this->userCan[$controller.'-'.$accion]=\Yii::$app->user->can($controller.'-'.$accion);
		}
	}
	
	protected function accion($var){
		return (strpos($var, 'action')!==false)&&($var!='actions');
	}
	
    public function actionView($id)
    {
    	return $this->redirect(['ver','id'=>$id]);
    }
    public function actionDelete($id)
    {
    	return $this->redirect(['borrar','id'=>$id]);
    }
    public function actionUpdate($id)
    {
    	return $this->redirect(['editar','id'=>$id]);
    }
    public function actionCreate()
    {
    	return $this->redirect(['crear']);
    }
}
?>