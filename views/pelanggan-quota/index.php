<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PelangganQuotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Pelanggan Quota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-quota-index">

    <h1><?php echo Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Pelanggan Quota', ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    <?php echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'pelanggan_id',
                'nominal',
                'user_insert',
                'insert_date',
                // 'user_update',
                // 'update_date',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>
</div>
