<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ciudad */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Ciudad',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciudades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['ver', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ciudad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	    'paises' => $paises,
	    'regiones' => $regiones,
    ]) ?>

</div>
