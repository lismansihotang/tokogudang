<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Penjualan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p>
        <?php echo Html::a('Create Penjualan', ['create'], ['class' => 'btn btn-success']); ?>
        <?php echo Html::a('Cek Stock', ['stock'], ['class' => 'btn btn-warning']); ?>
    </p>
    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        'id',
        'pelanggan.nm_pelanggan',
        'tgl',
        ['attribute' => 'subtotal', 'format' => ['decimal', 2], 'hAlign' => 'right', 'width' => '110px'],
        ['attribute' => 'disc', 'format' => ['decimal', 2], 'hAlign' => 'right', 'width' => '110px'],
        ['attribute' => 'total', 'format' => ['decimal', 2], 'hAlign' => 'right', 'width' => '110px'],
        [
            'class'    => 'kartik\grid\ActionColumn',
            'template' => '{view}{delete}'
        ]
    ];
    echo GridView::widget(
        [
            'id'               => 'kv-gridview-penjualan',
            'dataProvider'     => $dataProvider,
            'filterModel'      => $searchModel,
            'columns'          => $gridColumns,
        ]
    ); ?>
</div>
