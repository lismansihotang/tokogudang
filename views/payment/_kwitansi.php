<?php
use yii\grid\GridView;
use app\models\Pelanggan;
use app\models\Penjualan;
use app\models\Invoice;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
$this->title = $model->id;
$nm_pelanggan = '';
$modelInvoice = new Invoice();
$recordInvoice = $modelInvoice->findOne(['id' => $model->invoice_id]);
if ($recordInvoice !== null) {
    $modelPenjualan = new Penjualan();
    $recordPenjualan = $modelPenjualan->findOne(['id' => $recordInvoice['penjualan_id']]);
    if ($recordPenjualan !== null) {
        $modelPelanggan = new Pelanggan();
        $record = $modelPelanggan->findOne(['id' => $recordPenjualan['id_pelanggan']]);
        $nm_pelanggan = '';
        if ($record !== null) {
            $nm_pelanggan = $record['nm_pelanggan'];
        }
    }
}
?>
<div class="penjualan-view">
    <h1>Pembayaran</h1>

    <h3>#<?php echo $model->id; ?></h3>

    <p>
        No. Inv&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;#<?php echo $model->invoice_id; ?>
    </p>

    <p>
        Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $nm_pelanggan; ?>
    </p>

    <p>
        Tanggal&nbsp;&nbsp;:&nbsp;<?php echo $model->tgl; ?>
    </p>

    <div class="pull-right">
        <h2>
            <?php
            echo number_format(round($model->nominal)); ?>
        </h2>
        <?php echo '#' . Yii::$app->terbilang->rupiah(round($model->nominal)) . ' Rupiah#'; ?>
    </div>
</div>
