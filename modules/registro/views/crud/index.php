<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\registro\models\RegistroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Registro'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'almacen',
            'categoria',
            'elemento',
            'marca',
            // 'descripcion',
            // 'fecha',
            // 'cantidad',
            // 'unidad',
            // 'precio',
            // 'precio_unitario',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
