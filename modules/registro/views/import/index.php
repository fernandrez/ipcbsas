<?php
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
  <div class="col-sm-3">
      <?= $form->field($model, 'cadena_id')->dropDownList($cadenas,['prompt'=>'Selecciona Cadena']) ?>
  </div>
  <div class="col-sm-3">
      <?php
      echo $form->field($model, 'almacen_id')->widget(DepDrop::classname(), [
          'id'=>'registro-almacen_id',
          'pluginOptions'=>[
              'depends'=>['importform-cadena_id'],
              'placeholder'=>'Selecciona Almacen...',
              'url'=>Url::to(['/registro/almacen/almacenes-cadena'])
          ]
      ]);
      ?>
  </div>
  <div class="col-sm-4">
    <div class="form-group field-registro-fecha required">
      <?= '<label>Fecha</label>'; ?>
        <?= DatePicker::widget([
          'model' => $model,
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
<?= $form->field($model, 'file')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end(); ?>
