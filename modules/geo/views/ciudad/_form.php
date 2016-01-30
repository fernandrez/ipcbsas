<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\geo\assets\GeoAsset;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ciudad */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
GeoAsset::register($this,[
	'pais_field'=>'ciudad-pais_id',
	'region_field'=>'ciudad-region_id',
	'pais_id'=>$model->pais_id,
	'region_id'=>$model->region_id]);
?>
<div class="ciudad-form">
	
	<?php $form = ActiveForm::begin([
	     'enableClientValidation' => false,
	     'enableAjaxValidation' => false,
	     'options'=>['onsubmit'=>'guardar.disabled=true;return true;']
     ]); ?>
     
	<?= $form->field($model, 'pais_id')->dropDownList($paises,['prompt'=>'Escoge país']) ?>

    <?= $form->field($model, 'region_id')->dropDownList($regiones) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Guardar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
