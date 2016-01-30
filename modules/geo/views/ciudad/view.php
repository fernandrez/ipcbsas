<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ciudad */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ciudades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudad-view">

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
            ['attribute'=>'pais_id','value'=>$model->pais->nombre],
            'pais_cd',
            ['attribute'=>'region_id','value'=>$model->region->nombre],
            'region_cd',
            'nombre',
            'created_at',
            'updated_at',
            ['attribute'=>'created_by','value'=>$model->createdBy->username],
            ['attribute'=>'updated_by','value'=>isset($model->updatedBy)?$model->updatedBy->username:null],
            'status',
        ],
    ]) ?>

</div>
