<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Ciudad */

$this->title = Yii::t('app', 'Crear Ciudad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciudades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	    'paises' => $paises,
	    'regiones' => $regiones,
    ]) ?>

</div>
