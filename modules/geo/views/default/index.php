<?php
use yii\helpers\Html;
$this->title=\Yii::t('app','Geografía');
?>
<div class="geo-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a(\Yii::t('app','Ciudad'),['/geo/ciudad'],['class'=>'btn btn-danger']); ?>
    <?= Html::a(\Yii::t('app','Región'),['/geo/region'],['class'=>'btn btn-danger']); ?>
    <?= Html::a(\Yii::t('app','País'),['/geo/pais'],['class'=>'btn btn-danger']); ?>
</div>
