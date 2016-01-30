<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\registro\models\RegistroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'almacen') ?>

    <?= $form->field($model, 'categoria') ?>

    <?= $form->field($model, 'elemento') ?>

    <?= $form->field($model, 'marca') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'unidad') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'precio_unitario') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
