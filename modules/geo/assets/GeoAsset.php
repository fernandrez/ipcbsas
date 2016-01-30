<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\geo\assets;

use yii\web\AssetBundle;
use yii\helpers\Url;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GeoAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/geo/assets';
    public $js = [
    	'js/geodep.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
	public $publishOptions=['forceCopy'=>true];
	
	public static function register($view,$params=[]){
		if(!isset($params['rUrl'])){
			$params['rUrl']=Url::toRoute('/geo/region/get-regiones-pais');
		}
		if(!isset($params['cUrl'])){
			$params['cUrl']=Url::toRoute('/geo/ciudad/get-ciudades-region');
		}
		$headScript = 'var regionesAjaxUrl = "' . $params['rUrl'] . '";';
		$headScript .= 'var ciudadesAjaxUrl = "' . $params['cUrl'] . '";';
		$headScript .= 'var paisIdField = "' . $params['pais_field'] . '";';
		$headScript .= 'var regionIdField = "' . $params['region_field'] . '";';
		if(isset($params['ciudad_field'])){
			$headScript .= 'var ciudadIdField = "' . $params['ciudad_field'] . '";';
		}
		$headScript .= 'var paisId = "' . $params['pais_id'] . '";';
		$headScript .= 'var regionId = "' . $params['region_id'] . '";';
		if(isset($params['ciudad_id'])){
		$headScript .= 'var ciudadId = "' . $params['ciudad_id'] . '";';
		}
		$view->registerJs($headScript, View::POS_HEAD, 'geo-head-script');
		parent::register($view);
	}
}
