<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

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
            <?= $form->field($new, 'cadena_id')->dropDownList($cadenas,['prompt'=>'Selecciona Cadena']) ?>
        </div>
        <div class="col-sm-3">
            <?php //echo $form->field($new, 'almacen_id')->dropDownList($almacenes,['prompt'=>'Selecciona Almacén']) ?>
            <?php
            echo $form->field($new, 'almacen_id')->widget(DepDrop::classname(), [
                'id'=>'registro-almacen_id',
                'pluginOptions'=>[
                    'depends'=>['registro-cadena_id'],
                    'placeholder'=>'Selecciona Almacen...',
                    'url'=>Url::to(['/registro/almacen/almacenes-cadena'])
                ]
            ]);
            ?>
        </div>
		<div class="col-sm-3">
	    	<?= $form->field($new, 'categoria_id')->dropDownList($categorias,['prompt'=>'Selecciona Categoría']) ?>
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
	            'template'=>'{graph} {update}',
				'buttons'=>[
                    'graph' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-stats"></span>', Url::toRoute(['/registro/default/chart','id'=>$model->id]), [
                            'title' => Yii::t('yii', 'Graph'),
                            'data-pjax' => 0,
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['/registro/crud/update','id'=>$model->id]), [
                            'title' => Yii::t('yii', 'Graph'),
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
if($new->cadena_id != ''){
    $this->registerJs(
        "var ajaxData = {};
					ajaxData['depdrop_parents'][0] = ".$new->cadena_id.";
					ajaxData['depdrop_all_params']['registro-cadena_id'] = ajaxData['depdrop_parents'][0];
        $.ajax({
            url: '".Url::to(['/registro/almacen/almacenes-cadena'])."',
            method: 'POST',
            beforeSend: function(){ $('#registro-almacen_id').html(''); },
            data: ajaxData,
            error: function(a,b,c){alert(b+c);},
            success: function(data){
                var data = JSON.parse(data);
                $('#registro-almacen_id').html('');
                $('#registro-almacen_id').append('<option value>Selecciona Almacen..</option>');
                for(opt in data.output){
                    $('#registro-almacen_id').removeAttr('disabled');
                    if(data.output[opt].id == ".$new->almacen_id."){
                        $('#registro-almacen_id').append('<option selected=\"selected\" value=\"'+data.output[opt].id+'\">'+data.output[opt].name+'</option>');
                    } else {
                        $('#registro-almacen_id').append('<option value=\"'+data.output[opt].id+'\">'+data.output[opt].name+'</option>');
                    }
                }
            }
        })"
    );
}
?>

<?php
	$this->registerJs("$('div.registro-index').on('click', 'tbody tr', function(){
	    ajaxData = {};
		for(var p in $(this).data()){
			if($('#registro-'+p)){
			    if(p=='cadena_id'){
			      ajaxData['depdrop_parents'][0] = $(this).data()[p];
						ajaxData['depdrop_all_params']['registro-cadena_id'] = $(this).data()[p];
			    }
			    $('#registro-'+p).data('actval',$(this).data()[p]);
				$('#registro-'+p).val($(this).data()[p]);
			}
		}
        $.ajax({
            url: '".Url::to(['/registro/almacen/almacenes-cadena'])."',
            method: 'POST',
            beforeSend: function(){ $('#registro-almacen_id').html(''); },
            data: ajaxData,
            error: function(a,b,c){alert(b+c);},
            success: function(data){
                var data = JSON.parse(data);
                $('#registro-almacen_id').html('');
                $('#registro-almacen_id').append('<option value>Selecciona Almacen..</option>');
                for(opt in data.output){
                    $('#registro-almacen_id').removeAttr('disabled');
                    if($('#registro-almacen_id').data('actval')==data.output[opt].id){
                        $('#registro-almacen_id').append('<option selected=\"selected\" value=\"'+data.output[opt].id+'\">'+data.output[opt].name+'</option>');
                    } else {
                        $('#registro-almacen_id').append('<option value=\"'+data.output[opt].id+'\">'+data.output[opt].name+'</option>');
                    }
                }
            }
        });
	});", View::POS_END, 'pre-fill');
?>
