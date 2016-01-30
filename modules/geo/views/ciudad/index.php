<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CiudadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ciudades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php if($userCan['ciudad-create']): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Crear Ciudad'), ['crear'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php endif; ?>

<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            ['attribute'=>'pais_id','value'=>function($data){return $data->pais->nombre;},'filter'=>$paises],
            'pais_cd',
            ['attribute'=>'region_id','value'=>function($data){return $data->region->nombre;},'filter'=>$regiones],
            'region_cd',
            'nombre',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            'status',

            [
            	'class' => 'yii\grid\ActionColumn',
            	'template'=>'{ver} {editar} {borrar}',        	
				'buttons' => [
				  'ver' => function ($url, $model) {
				      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
				                  'title' => Yii::t('app', 'Ver'),
				                  'data-pjax' => 0,
				      ]);
				  },
				  'editar' => function ($url, $model) {
				      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
				                  'title' => Yii::t('app', 'Editar'),
				                  'data-pjax' => 0,
				      ]);
				  },
				  'borrar' => function ($url, $model) {
				      return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
				                  'title' => Yii::t('app', 'Borrar'),
				                  'data-pjax' => 0,
									'data-confirm' => Yii::t('yii', 'Seguro que deseas borrar este elemento?'),
				      ]);
				  }
				],
				'urlCreator' => function ($action, $model, $key, $index) {
				      $url = Url::toRoute([$action,'id'=>$model->id]);
				      return $url;
				}
            ]
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>

</div>
