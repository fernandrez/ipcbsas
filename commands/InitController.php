<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\db\Connection;
use dektrium\user\Finder;
use dektrium\user\models\User;
use dektrium\user\models\Token;
use app\modules\geo\models\Pais;
use app\modules\geo\models\Region;
use app\modules\geo\models\Ciudad;
use app\modules\geo\models\DireccionParametro;
use app\models\ConsoleUser;

class InitController extends Controller
{
	public $cn;
	public $admin_id=1;
	public $argentina_id=1, $buenos_aires=1, $capital=1;
	
	public function actionFull(){
		$this->cn=\Yii::$app->db;
		$this->actionUsersRbac();
		$this->actionDirPars();
		$this->actionGeo();
		$this->actionAppPars();
		$this->actionRegs();
	}
	
	public function actionFullDummy(){
		$this->actionFull();
	}
	
	public function actionUsersRbac(){
    	$this->cn=\Yii::$app->db;
		
		echo 'Inicializando tablas de usuarios'.PHP_EOL;
		$this->cn->createCommand('set foreign_key_checks=0;
			truncate token;truncate social_account;foreign_key_checks=1;')->execute();
		$this->cn->createCommand('set foreign_key_checks=0;truncate social_account;foreign_key_checks=1;')->execute();
		$this->cn->createCommand('set foreign_key_checks=0;truncate profile;foreign_key_checks=1;')->execute();
		$this->cn->createCommand('set foreign_key_checks=0;truncate user;foreign_key_checks=1;')->execute();
		
		echo 'Registrando administrador'.PHP_EOL;
		$fernandrez= $this->createUser('fernandrez@gmail.com','fernandrez','fernandrez2015');
				
		echo 'Inicializando tablas de autenticacion'.PHP_EOL;
		$this->cn->createCommand('set foreign_key_checks=0;truncate auth_item_child;
			truncate auth_assignment;
			truncate auth_item;
			truncate auth_rule;
			foreign_key_checks=1;')->execute();
        $auth = Yii::$app->authManager;
		
		echo 'Creando permisos'.PHP_EOL;
        //Controladores y sus acciones
		$actions['base']=[];
        $actions['geo']['default']=['index'];
        $actions['geo']['pais']=['index','ver','editar','crear','borrar'];
        $actions['geo']['region']=['index','ver','editar','crear','borrar','get-regiones-pais'];
        $actions['geo']['ciudad']=['index','ver','editar','crear','borrar','get-ciudades-region'];
        $actions['parametros']['listado']=['index','ver','editar','crear','borrar'];
        $actions['registro']['default']=['index'];
		$actions['registro']['crud']=['index','view','update','create','delete'];
        $actions['user']['admin']=['index','create','update','update-profile','info','assignments','confirm','delete','block',];
        
        $modules=array_filter(array_keys($actions),function($v){return $v!='base';});
		
		foreach($modules as $m){
			$controllers=array_keys($actions[$m]);
			foreach($controllers as $i=>$c){
				if(!is_array($actions[$m][$c])){
					if($i==0){
						$actions[$m]=array_merge($actions['base'],isset($actions[$m])?$actions[$m]:[]);
						break;
					}
				}else{
					$actions[$m][$c]=array_merge($actions['base'],isset($actions[$m][$c])?$actions[$m][$c]:[]);
				}
			}
		}

        $fcp='full-controller-permission';
		foreach($modules as $m){
			$controllers=array_keys($actions[$m]);
			if(!is_array($actions[$m][$controllers[0]])){
				$controllers=array_values($actions[$m]);
			}
			foreach($controllers as $i=>$c){
				if(!isset($actions[$m][$c])){
					if($i==0){
						$permissions[$m][$fcp]=$auth->createPermission($m.'-'.$fcp);
						$permissions[$m][$fcp]->description = $m.'-'.$fcp;
						$auth->add($permissions[$m][$fcp]);
					}
					$permissions[$m][$c]=$auth->createPermission($m.'-'.$c);
					$permissions[$m][$c]->description = $m.'-'.$c;
					$auth->add($permissions[$m][$c]);
					$auth->addChild($permissions[$m][$fcp],$permissions[$m][$c]);
				}
				else{
					$permissions[$m][$c][$fcp]=$auth->createPermission($m.'-'.$c.'-'.$fcp);
					$permissions[$m][$c][$fcp]->description = $m.'-'.$c.'-'.$fcp;
					$auth->add($permissions[$m][$c][$fcp]);
					foreach($actions[$m][$c] as $a){
						$permissions[$m][$c][$a]=$auth->createPermission($m.'-'.$c.'-'.$a);
						$permissions[$m][$c][$a]->description = $m.'-'.$c.'-'.$a;
						$auth->add($permissions[$m][$c][$a]);
						$auth->addChild($permissions[$m][$c][$fcp],$permissions[$m][$c][$a]);
					}
				}
			}		
		}

		echo 'Creando roles'.PHP_EOL;
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
		
		echo 'Asignando permisos a rol admin'.PHP_EOL;
        foreach($permissions as $m=>$permission){
        	foreach($permission as $c=>$p){
        		if(!is_array($p)){
        			if($c==0){		
        				$auth->addChild($adminRole, $permission[$fcp]);
						break;
					}
        		}else{
        			$auth->addChild($adminRole, $p[$fcp]);
        		}
			}
		}
		
		echo 'Asignando roles a usuarios'.PHP_EOL;
		//Admin
        $auth->assign($adminRole, $fernandrez->id);$this->admin_id=$fernandrez->id;
    }

	public function actionAppPars(){
    	$this->cn=\Yii::$app->db;
		
		echo 'Inicializando tabla de parametros de aplicacion'.PHP_EOL;
		$this->cn->createCommand('set foreign_key_checks=0;truncate parametro;foreign_key_checks=1;')->execute();
		$fields=['nombre', 'valor', 'fecha_inicio', 'created_by'];
		
		$data=[
		];
		$this->batchInsert('app\modules\parametros\models\Parametro',$fields,$data);
	}

	private function createUser($email,$username,$password){
		
		$user= new ConsoleUser(['scenario'=>'register']);
		$user->setAttributes([
            'email'    => $email,
            'username' => $username,
            'password' => $password,
            'confirmed_at' => time(),
        ]);
		$user->register();
		
		return $user;
	}

	public function actionGeo(){
    	$this->cn=\Yii::$app->db;
		
		echo 'Inicializando tablas de geografia'.PHP_EOL;
		$this->cn->createCommand('set foreign_key_checks=0;truncate direccion;truncate ciudad;truncate region;truncate pais;foreign_key_checks=1;')->execute();
		$fields=['pais_cd', 'nombre', 'created_by'];
		$data=[
			['AR','Argentina',$this->admin_id],
		];
		
		echo 'Insertando paises'.PHP_EOL;
		$ids_paises=$this->batchInsert('app\modules\geo\models\Pais',$fields,$data);
		
		$this->argentina_id=$ids_paises[0];
		
		$fields=['pais_id', 'region_cd', 'nombre', 'created_by'];
		$data=[
			[$this->argentina_id, 'BUE','Buenos Aires',$this->admin_id],
		];
		
		echo 'Insertando regiones'.PHP_EOL;
		$ids_regiones=$this->batchInsert('app\modules\geo\models\Region',$fields,$data);
		
		
		$this->buenos_aires=$ids_regiones[0];
		
		$fields=['pais_id', 'region_id', 'nombre', 'created_by'];
		$data=[
			[$this->argentina_id, $this->buenos_aires,'Capital',$this->admin_id],
		];
		
		echo 'Insertando ciudades'.PHP_EOL;
		$ids_ciudades=$this->batchInsert('app\modules\geo\models\Ciudad',$fields,$data);
		
		$this->capital=$ids_ciudades[0];
		/*
		echo 'Insertando direcciones'.PHP_EOL;
		
		$fieldsDir=['via_id', 'numero_via', 'numero_cruce', 'numero_entrada', 'comentario', 'created_by'];
		$dataDir=[
		];
		$dirIds=$this->batchInsert('app\modules\geo\models\Direccion',$fieldsDir,$dataDir);*/
	}

	public function actionDirPars(){
    	$cn=\Yii::$app->db;
		
		echo 'Inicializando tabla de parametros de direccion'.PHP_EOL;
		$cn->createCommand('set foreign_key_checks=0;truncate direccion_parametro;foreign_key_checks=1;')->execute();
		$fields=['tipo', 'codigo', 'titulo', 'descripcion', 'created_by'];
		$data=[
			['via','CL','Calle','Calle',$this->admin_id],
			['via','KR','Carrera','Carrera',$this->admin_id],
			['via','TR','Transversal','Transversal',$this->admin_id],
			['via','DG','Diagonal','Diagonal',$this->admin_id],
			['via','CR','Circular','Circular',$this->admin_id],
			['via','Via','Via','Via',$this->admin_id],
			['mod','S','Sur','Sur',$this->admin_id],
			['mod','N','Norte','Norte',$this->admin_id],
			['interior','Apt','Apartamento','Apartamento',$this->admin_id],
			['interior','Casa','Casa','Casa',$this->admin_id],
			['interior','Bod','Bodega','Bodega',$this->admin_id],
			['interior','Lote','Lote','Lote',$this->admin_id],
			['interior','Int','Interior','Interior',$this->admin_id],
		];
		$this->batchInsert('app\modules\geo\models\DireccionParametro',$fields,$data);
	}

	public function actionRegs(){
    	$cn=\Yii::$app->db;
		
		echo 'Inicializando tabla de registro'.PHP_EOL;
		$cn->createCommand('set foreign_key_checks=0;truncate registro;foreign_key_checks=1;')->execute();
		$fields=['almacen','categoria','elemento','marca','descripcion','fecha','cantidad','unidad','precio','precio_unitario','created_by','order'];
		$data=[
['Disco Rodriguez Peña','Carnes','Pechuga Pollo','','','2015-12-27',1,'kg',85.00,85.00,1,0],
['Carrefour Nuñez','Carnes','Chorizo Gancho','','','2016-01-21',1,'kg',75.00,75.00,1,0],
['Carrefour Nuñez','Carnes','Muslos Pollo','','','2016-01-21',1,'kg',42.00,42.00,1,0],
['Carrefour Rodriguez Peña','Carnes','Bondiola','','','2015-12-30',1,'kg',103.00,103.00,1,0],
['Carrefour Nuñez','Carnes','Bondiola','','','2016-01-21',1,'kg',114.00,114.00,1,0],
['Disco Rodriguez Peña','Carnes','Bondiola','','','2015-12-30',1,'kg',129.99,129.99,1,0],
['Carrefour Rodriguez Peña','Carnes','Carre de Cerdo','','','2015-12-30',1,'kg',115.00,115.00,1,0],
['Disco Rodriguez Peña','Carnes','Carre de Cerdo','','','2015-12-30',1,'kg',140.39,140.39,1,0],
['Carrefour Rodriguez Peña','Carnes','Carne Picada','','','2015-12-30',1,'kg',94.90,94.90,1,0],
['Disco Rodriguez Peña','Carnes','Carne Picada','','','2015-12-30',1,'kg',89.90,89.90,1,0],
['Disco Rodriguez Peña','Carnes','Nalga','','','2015-12-30',1,'kg',143.99,143.99,1,0],
['Disco Rodriguez Peña','Carnes','Bola de Lomo','','','2015-12-30',1,'kg',129.99,129.99,1,0],
['Disco Rodriguez Peña','Cereales','Choco Krispis','Kellogs','','2015-12-27',0.35,'kg',54.10,154.57,1,0],
['Carrefour Rodriguez Peña','Cereales','Honey Graham','Quaker','','2015-12-27',0.2,'kg',30.00,150.00,1,0],
['Carrefour Rodriguez Peña','Cereales','Zucaritas','Kellogs','','2015-12-27',0.3,'kg',33.60,112.00,1,0],
['Disco Rodriguez Peña','Cereales','Zucaritas','Kellogs','','2015-12-27',0.3,'kg',35.25,117.50,1,0],
['Disco Rodriguez Peña','Enlatados','Poroto Lata','Jumbo','','2015-12-27',1,'kg',52.00,52.00,1,0],
['Disco Rodriguez Peña','Frutas','Fresa','','','2015-12-27',1,'kg',80.00,80.00,1,0],
['Fruver Guido','Frutas','Manzana','','','2015-12-28',2,'kg',45,22.50,1,0],
['Fruver Guido','Frutas','Naranja','','','2015-12-28',2,'kg',25,12.50,1,0],
['Disco Rodriguez Peña','Frutas','Uva','','','2015-12-27',1,'kg',50.00,50.00,1,0],
['Carrefour Rodriguez Peña','Galletas','Pepitos','Pepitos','Mini','2015-12-27',0.15,'kg',18.00,120.00,1,0],
['Disco Rodriguez Peña','Galletas','Pepitos','Pepitos','','2015-12-27',0.354,'kg',33.85,95.62,1,0],
['Carrefour Rodriguez Peña','Panes','Pan Tajado','Oroweat','Pan Semillas','2015-12-30',0.6,'kg',57,95,1,0],
['Disco Rodriguez Peña','Panes','Pan Tajado','Oroweat','Pan Semillas','2015-12-30',0.6,'kg',68.1,113.5,1,0],
['Carrefour','Panes','Pan Tajado','Oroweat','Pan Cereales','2015-12-30',0.6,'kg',57,95,1,0],
['Disco Rodriguez Peña','Panes','Pan Tajado','Oroweat','Pan Cereales','2015-12-30',0.6,'kg',68.1,113.5,1,0],
['Carrefour Rodriguez Peña','Panes','Pan Tajado','Bimbo','Liviano','2015-12-30',0.4,'kg',39,97.5,1,0],
['Disco Rodriguez Peña','Panes','Pan Tajado','Bimbo','Liviano','2015-12-30',0.4,'kg',39,97.5,1,0],
['Carrefour Rodriguez Peña','Panes','Pan Tajado','Bimbo','Acti Leche','2015-12-30',0.4,'kg',39,97.5,1,0],
['Disco Rodriguez Peña','Panes','Pan Tajado','Bimbo','Acti Leche','2015-12-30',0.4,'kg',39,97.5,1,0],
['Carrefour Rodriguez Peña','Lacteos','Crema de Leche','Carrefour','','2015-12-28',0.2,'l',10.25,51.25,1,0],
['Carrefour Rodriguez Peña','Lacteos','Leche','Carrefour','Entera','2015-12-27',1,'l',10.00,10.00,1,0],
['Carrefour Rodriguez Peña','Lacteos','Leche','Serenisima','Parcialmente Descremada','2015-12-30',1,'l',15.40,15.40,1,0],
['Disco Rodriguez Peña ','Lacteos','Leche','Serenisima','Parcialmente Descremada','2015-12-30',1,'l',15.79,15.79,1,0],
['Disco Rodriguez Peña','Lacteos','Leche','Serenisima','Entera','2015-12-27',1,'l',10.00,10.00,1,0],
['Disco Rodriguez Peña','Lacteos','Yogurt','Serenisima','','2015-12-27',1.3,'kg',30.00,23.08,1,0],
['Carrefour Rodriguez Peña','Panaderia','Medialuna','Carrefour','','2015-12-27',0.03,'kg',23.20,773.33,1,0],
['Disco Rodriguez Peña','Personal','Papel Higienico','Elite','Ultra Doble Hoja x 18','2015-12-27',18,'m2',58.65,3.26,1,0],
['Disco Rodriguez Peña','Personal','Papel Higienico','Elite','Ultra Doble Hoja x 36','2015-12-27',36,'m2',110.69,3.07,1,0],
['Disco Rodriguez Peña','Personal','Shampoo','H&S','Relax','2015-12-27',0.7,'l',117.35,167.64,1,0],
['Disco Rodriguez Peña','Personal','Shampoo','Pantene','Hidro-cauterizacion','2015-12-27',0.75,'l',102.00,136.00,1,0],
['Carrefour Rodriguez Peña','Personal','Shampoo','Pantene','Hidro-cauterizacion','2015-12-27',0.75,'l',109.00,145.33,1,0],
['Farmacity','Personal','Shampoo','Pantene','Hidro-cauterizacion','2015-12-27',0.75,'l',117.00,156.00,1,0],
['Disco Rodriguez Peña','Verduras','Brocoli','','','2015-12-27',1,'kg',35,35,1,0],
['Disco Rodriguez Peña','Verduras','Cebolla','','','2015-12-27',1,'kg',18,18,1,0],
['Fruver Guido','Verduras','Cebolla','','','2015-12-28',1,'kg',15,15.00,1,0],
['Fruver Guido','Verduras','Choclo','','','2015-12-28',3,'und',20,6.67,1,0],
['Disco Rodriguez Peña','Verduras','Puerro','','','2015-12-27',0.23,'kg',12.00,52.17,1,0],
['Disco Rodriguez Peña','Verduras','Tomate','','','2015-12-27',1,'kg',20.00,20.00,1,0],
['Carrefour Rodriguez Peña','Verduras','Tomate','','','2015-12-27',1,'kg',25.00,25.00,1,0],
['Fruver Guido','Verduras','Tomate','','','2015-12-28',2,'kg',20,10.00,1,0],
['Disco Rodriguez Peña','Verduras','Zanahoria','','','2015-12-27',1,'kg',15,15,1,0],
['Carrefour Nuñez','Carnes','Fuet','Tandil','','2016-01-10',0.15,'kg',77,513.33,1,0],
['Carrefour Nuñez','Panaderia','Rapiditas','Bimbo','','2016-01-10',0.33,'kg',40,121.21,1,0],
['Carrefour Nuñez','Carnes','Mix Pollo','','','2016-01-10',0.57,'kg',83.22,146.00,1,0],
['Carrefour Nuñez','Carnes','Carne Molida','','','2016-01-10',0.564,'kg',21.57,38.24,1,0],
		];
		$this->batchInsert('app\modules\registro\models\Registro',$fields,$data);
	}

	private function batchInsert($model,$fields,$data){
		$ret=[];
		foreach($data as $d){
			$m=new $model;$setA=[];	
			foreach($fields as $k=>$f){
				$setA[$f]=$d[$k];
			}
			$m->setAttributes($setA);
			$m->detachBehavior('blameable');
			$m->detachBehavior('eav');
			$m->save();
			if(count($m->errors)>0){
				var_dump($m->errors);
				var_dump($m->attributes);die;
			}
			$ret[]=$m->id;
		}
		return $ret; 
	}
}