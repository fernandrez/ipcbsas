<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'IPC BsAs';
?>
<div class="site-index">
    <ul class="nav nav-pills">
        <li><?= Html::a("Registros",'/registro'); ?></li>
        <li><?= Html::a("Categorías",'/registro/categoria'); ?></li>
        <li><?= Html::a("Cadenas",'/registro/cadena'); ?></li>
        <li><?= Html::a("Almacenes",'/registro/almacen'); ?></li>
        <li><?= Html::a("Importar",'/registro/import'); ?></li>
    </ul>
</div>
