<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\registro\models\Almacen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Almacen',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="almacen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
