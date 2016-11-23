<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan Quota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-quota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="btn-group margin-bottom-5">
        <?php
        echo Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']);
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
        echo Html::a(
            'Delete',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-sm btn-danger',
                'data'  => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method'  => 'post',
                ],
            ]
        ); ?>
    </div>

    <?php echo DetailView::widget(
        [
            'model'      => $model,
            'attributes' => [
                'id',
                'pelanggan_id',
                'nominal',
                'user_insert',
                'insert_date',
                'user_update',
                'update_date',
            ],
        ]
    ); ?>

</div>
