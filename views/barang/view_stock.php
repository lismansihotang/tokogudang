<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'List Stock Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">
    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'nm_barang',
                'stock:integer',
            ],
        ]
    ); ?>
</div>
