<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Parametro */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Parametro',
]) . ' ' . $id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parametros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $id, 'url' => ['ver', 'id' => $id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="parametro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
