<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Pais */

$this->title = Yii::t('app', 'Crear Pais');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
