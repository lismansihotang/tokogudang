<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Barang Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_barang',
            'barcode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
