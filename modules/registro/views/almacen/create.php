<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\registro\models\Almacen */

$this->title = Yii::t('app', 'Create Almacen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Almacenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="almacen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cadenas' => $cadenas,
    ]) ?>

</div>
