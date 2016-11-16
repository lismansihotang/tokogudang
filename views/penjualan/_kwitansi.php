<?php
use yii\grid\GridView;
use app\models\Pelanggan;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
$this->title = $model->id;
$modelPelanggan = new Pelanggan();
$record = $modelPelanggan->findOne(['id' => $model->id_pelanggan]);
$nm_pelanggan = '';
if ($record !== null) {
    $nm_pelanggan = $record['nm_pelanggan'];
}
?>
<div class="penjualan-view">
    <h1>Kwitansi</h1>

    <h3>#<?php echo $model->id; ?></h3>

    <p>
        Nama&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $nm_pelanggan; ?>
    </p>

    <p>
        Tanggal&nbsp;:&nbsp;<?php echo $model->tgl; ?>
    </p>
    <?php
    echo GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'barang.nm_barang',
                'jml',
                'harga:decimal',
                'subtotal:decimal',
            ],
        ]
    ); ?>
    <div class="pull-right">
        <h2>
            <?php
            echo number_format(round($model->total)); ?>
        </h2>
        <?php echo '#' . Yii::$app->terbilang->rupiah(round($model->total)) . ' Rupiah#'; ?>
    </div>
</div>
