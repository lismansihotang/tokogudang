<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CashRegisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cash Registers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-register-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cash Register', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shift_id',
            'tgl',
            'nominal',
            'start_cash',
            // 'finish_cash',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
