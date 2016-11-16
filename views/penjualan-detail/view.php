<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PenjualanDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penjualan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <div class="btn-group">
        <?= Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </div>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_penjualan',
            'id_barang',
            'jml',
            'harga',
            'subtotal',
        ],
    ]) ?>

</div>
