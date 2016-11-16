<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BarangDetail */

$this->title = 'Create Barang Detail';
$this->params['breadcrumbs'][] = ['label' => 'Barang Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
