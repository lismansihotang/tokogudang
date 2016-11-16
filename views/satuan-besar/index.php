<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SatuanBesarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Satuan Pembelian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-besar-index">

    <h1><?php echo Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Satuan Pembelian', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nm_satuan',
            'konversi_satuan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
