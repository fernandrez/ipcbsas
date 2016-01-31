<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\registro\models\RegistroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $reg->categoria.' '.$reg->elemento;
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php echo \yii2mod\c3\chart\Chart::widget([
    'options' => [
		'id' => 'chart'
    ],
    'clientOptions' => [
    	'data' => [
    		'xs' => $xs,
    		'columns' => $columns,
    	],
    	'axis' => [
    		'x' => [
    			'type' => 'timeseries',
    			'tick' => [
    				'format' => '%Y-%m-%d',
    			]
    		]
    	],
    ]
]); ?>

<div class="registro-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'almacen',
            'categoria',
            'elemento',
            'marca',
            'descripcion',
            'fecha',
            // 'cantidad',
            // 'unidad',
            // 'precio',
            ['attribute'=>'precio_unitario','value' => function($data){return round($data->precio_unitario,2).' / '.$data->unidad;}],
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'status',
        ],
        'rowOptions' => function($model, $key, $index, $grid){
        	$opt = [];
        	foreach($model->attributes as $att => $val){
        		$opt['data-'.$att] = $val;
			}
			return $opt;
		},
    ]); ?>
<?php Pjax::end(); ?></div>

<?php
	$this->registerJs("$('div.registro-index').on('click', 'tr', function(){
		for(var p in $(this).data()){
			if($('#registro-'+p)){
				$('#registro-'+p).val($(this).data()[p]);
			}
		}
	});", View::POS_END, 'pre-fill');
?>
