<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Region */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Region',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regiones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['ver', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'paises' => $paises,
    ]) ?>

</div>
