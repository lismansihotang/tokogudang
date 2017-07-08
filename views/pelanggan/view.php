<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */
Icon::map($this);
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin(
    [
        'header' => '<h3>Form Detail Saldo</h3>',
        'id' => 'modal',
        'size' => 'modal-md'
    ]
);
echo '<div id="modalContent"></div>';
Modal::end();
?>
<div class="pelanggan-view">
    <div class="row">
        <div class="col-md-offset-10 col-md-2">
            <a class="btn btn-info" href="#" target="_blank">
                <?php echo Icon::show('money', ['class' => 'fa-3x'], Icon::FA); ?>
                <br>
                Saldo
                <h2><?php echo number_format($saldo); ?></h2>
            </a>
        </div>
    </div>
    <p>

    <div class="btn-group">
        <?= Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?php
        echo Html::button(
            'Saldo Pelanggan',
            [
                'value' => Yii::$app->urlManager->createAbsoluteUrl(['pelanggan-quota/create', 'id_pelanggan' => $model->id]),
                'class' => 'btn btn-sm btn-warning',
                'id' => 'modalButton'
            ]
        );
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nm_pelanggan',
            'alamat:ntext',
            'no_telp',
            'barcode',
            'card_number',
            'tgl_bergabung',
            'tipe',
        ],
    ]);
    ?>
    <table class="table table-bordered table-responsive table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th>Tgl</th>
            <th>Nominal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($modelPenjualan) > 0) {
            $i = 1;
            foreach ($modelPenjualan as $row) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->tgl; ?></td>
                    <td><?php echo number_format($row->total); ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </tbody>
    </table>

</div>

