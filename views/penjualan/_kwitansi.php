<?php
use app\models\Pelanggan;
use yii\helpers\Url;

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
    <h1>Toko De Apik</h1>
    <h4>#<?php echo $model->id . '/' . $model->tgl . '/' . $nm_pelanggan; ?></h4>
    <h5>Jalan raya kalibata no. 17, Jakarta</h5>

    <div class="pull-right">
        <table>
            <tbody>
            <tr>
                <td colspan="3"><?php echo str_repeat('=', 35); ?></td>
            </tr>
            <?php
            if (count($modelDetail) > 0) {
                foreach ($modelDetail as $row) {
                    if (array_key_exists($row->id_barang, $modelBarang) === true) {
                        $nmBarang = $modelBarang[$row->id_barang];
                        echo '<tr>';
                        echo '<td>' . $nmBarang . '</td>';
                        echo '<td>' . $row->jml . ' @' . number_format($row->harga) . '</td>';
                        echo '<td style="text-align: right;">' . number_format($row->subtotal) . '</td>';
                        echo '</tr>';
                    }
                }
            }
            ?>
            <tr>
                <td colspan="3"><?php echo str_repeat('-', 53); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Subtotal</td>
                <td style="text-align: right;"><?php echo number_format($model->subtotal); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Disc</td>
                <td style="text-align: right;"><?php echo number_format($model->disc); ?></td>
            </tr>
            <tr>
                <td colspan="3"><?php echo str_repeat('-', 53); ?></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><h1><?php echo number_format(round($model->total)); ?></h1>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">
                    <?php echo str_repeat('-', 24); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Bayar</td>
                <td style="text-align: right;"><?php echo number_format($model->pembayaran); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Kembali</td>
                <td style="text-align: right;"><?php echo number_format($model->pembayaran - $model->total); ?></td>
            </tr>
            <tr>
                <td colspan="3"><?php echo '#' . Yii::$app->terbilang->rupiah(
                            round($model->total)
                        ) . ' Rupiah#'; ?></td>
            </tr>
            </tbody>
        </table>
        <?php
        /**echo str_repeat('-', 55);
         * echo '</br>';
         * if (count($modelDetail) > 0) {
         * foreach ($modelDetail as $row) {
         * if (array_key_exists($row->id_barang, $modelBarang) === true) {
         * $nmBarang = $modelBarang[$row->id_barang];
         * $lengthCount = 47 - (integer)strlen(trim($nmBarang));
         * if ($lengthCount > 25 && $lengthCount < 36) {
         * $lengthCount = $lengthCount - 3;
         * } elseif ($lengthCount < 25) {
         * $lengthCount = $lengthCount - 12;
         * }
         * echo $row->jml . ' ' . str_repeat('&nbsp;', 2) . $nmBarang . str_repeat(
         * '&nbsp;',
         * $lengthCount
         * ) . number_format($row->subtotal) . '</br>';
         * }
         * }
         * }
         * echo '<br/>';
         * echo str_repeat('&nbsp;', 44) . 'Subtotal&nbsp;&nbsp;: ' . number_format($model->subtotal);
         * echo '<br/>';
         * if ((integer)($model->disc) <= 0) {
         * echo str_repeat('&nbsp;', 44) . 'Discount : ' . str_repeat('&nbsp;', 8) . number_format($model->disc);
         * } else {
         * echo str_repeat('&nbsp;', 44) . 'Discount : ' . number_format($model->disc);
         * }
         * ?>
         * <h2>
         * <?php
         * echo str_repeat('-', 38) . '</br>';
         * echo number_format(round($model->total)); ?>
         * </h2>
         * <?php
         * echo str_repeat('-', 55) . '</br>';
         * echo str_repeat('&nbsp;', 55) . 'Cash : ' . number_format($model->pembayaran);
         * echo '<br/>';
         * echo str_repeat('&nbsp;', 50) . 'Kembali : ' . number_format($model->pembayaran - $model->total);
         * echo '</br></br>';
         * echo '#' . Yii::$app->terbilang->rupiah(round($model->total)) . ' Rupiah#'; */ ?>
    </div>
    <p>Terima Kasih atas kunjungan anda</p>
</div>
<?php shell_exec('D:/CashDrawer/run.exe'); ?>
<script>
    window.print();
    window.location = '<?php echo Url::toRoute('site/index'); ?>';
</script>