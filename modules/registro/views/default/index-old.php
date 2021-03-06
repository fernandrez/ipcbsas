<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\registro\models\RegistroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registros');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="registro-form">
	
    <?php $form = ActiveForm::begin(['action' => '/registro']); ?>
	
	<?php echo $form->errorSummary($new); ?>
    
	<div class="row">
		<div class="col-sm-3">
	    	<?= $form->field($new, 'almacen')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">
	    	<?= $form->field($new, 'categoria')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">
			<div class="form-group field-registro-fecha required">
				<?= '<label>Fecha</label>'; ?>
	    		<?= DatePicker::widget([
				    'model' => $new,
				    'attribute' => 'fecha',
        			//'type'=> \kartik\date\DatePicker::TYPE_INPUT,
				    'pluginOptions' => [
				        'format' => 'yyyy-mm-dd',
				        'todayHighlight' => true
				    ]
				]); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-3">
    		<?= $form->field($new, 'marca')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">
   			<?= $form->field($new, 'elemento')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">
    		<?= $form->field($new, 'descripcion')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-3">	
    		<?= $form->field($new, 'cantidad')->textInput() ?>
		</div>
		<div class="col-sm-3">
    		<?= $form->field($new, 'unidad')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">
    		<?= $form->field($new, 'precio')->textInput() ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="registro-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            [
	            'class' => 'yii\grid\ActionColumn',
	            'template'=>'{view}',
				'buttons'=>[
					'view' => function ($url, $model) {     
						return Html::a('<span class="glyphicon glyphicon-stats"></span>', Url::toRoute(['/registro/default/chart','id'=>$model->id]), [
							'title' => Yii::t('yii', 'View'),
							'data-pjax' => 0,
				        ]);                                
				
				    }
				]                            
			],
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
