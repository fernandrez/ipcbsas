<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Parametro */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parametros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parametro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['editar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'valor',
            'fecha_inicio',
            'fecha_fin',
            'created_at',
            'updated_at',
            ['attribute'=>'created_by','value'=>$model->createdBy->username],
            'status',
        ],
    ]) ?>

</div>
