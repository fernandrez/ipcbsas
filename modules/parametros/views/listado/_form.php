<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Parametro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parametro-form">
	
	<?php $form = ActiveForm::begin([
	     'enableClientValidation' => false,
	     'enableAjaxValidation' => false,
	     'options'=>['onsubmit'=>'guardar.disabled=true;return true;']
     ]); ?>
     
	<?= $form->field($model, 'nombre')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'valor')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
