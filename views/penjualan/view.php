<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pembayaran = (integer)$model->pembayaran;
?>
<div class="penjualan-view">
    <h1>#<?php echo Html::encode($this->title) ?></h1>

    <div class="btn-group margin-bottom-5">
        <?php
        echo Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']);
        if ($pembayaran <= 0) {
            echo Html::a(
                'Update',
                Url::to(['penjualan-detail/create', 'id-jual' => $model->id]),
                ['class' => 'btn btn-sm btn-primary']
            );
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
            );
        }
        echo Html::a(
            'Print',
            ['print', 'id' => $model->id],
            ['class' => 'btn btn-sm btn-warning', 'id' => 'btn-for-print']
        ); ?>
    </div>
    <?php echo DetailView::widget(
        [
            'model'      => $model,
            'attributes' => [
                'id',
                'tgl',
                'pelanggan.nm_pelanggan',
                'subtotal:decimal',
                'disc:decimal',
                'total:decimal',
                'pembayaran:decimal',
                'tipe_bayar',
            ],
        ]
    ); ?>

</div>