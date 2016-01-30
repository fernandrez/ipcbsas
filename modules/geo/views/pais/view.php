<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pais */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['editar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['borrar', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Estás seguro de querer eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pais_cd',
            'nombre',
            'created_at',
            'updated_at',
            ['attribute'=>'created_by','value'=>$model->createdBy->username],
            ['attribute'=>'updated_by','value'=>isset($model->updatedBy)?$model->updatedBy->username:null],
            'status',
        ],
    ]) ?>

</div>
