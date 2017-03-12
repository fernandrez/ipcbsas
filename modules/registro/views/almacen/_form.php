<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\registro\models\Almacen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="almacen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cadena_id')->dropDownList($cadenas) ?>

    <?= $form->field($model, 'identificador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitud')->textInput() ?>

    <?= $form->field($model, 'longitud')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
