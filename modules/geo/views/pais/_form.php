<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pais-form">
	
	<?php $form = ActiveForm::begin([
	     'enableClientValidation' => false,
	     'enableAjaxValidation' => false,
	     'options'=>['onsubmit'=>'guardar.disabled=true;return true;']
     ]); ?>
     
	<?= $form->field($model, 'pais_cd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Guardar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
