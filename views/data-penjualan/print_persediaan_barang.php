<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Persediaan Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title) ?></h1>
<?php
if (count($modelCalc) > 0) {
    echo '<h1>Rp. ' . number_format($modelCalc[0]['total']) . '</h1>';
    echo '<h3>' . number_format($modelCalc[0]['stock']) . '</h3>';
}
?>
<table style="border-spacing: 0;">
    <thead>
    <tr>
        <th style="border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;">No</th>
        <th style="border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;">Barang</th>
        <th style="border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;">Harga</th>
        <th style="border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;">Stock</th>
        <th style="border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000; border-right: 1px solid #000;">Subtotal</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalStock = 0;
    $total = 0;
    if (count($model) > 0) {
        $i = 1;
        foreach ($model as $row) {
            $subtotal = $row['stock'] * $row['harga_jual'];
            $totalStock += $row['stock'];
            $total += $subtotal;
            ?>
            <tr>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: center;"><?php echo $i; ?></td>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000;"><?php echo $row['nm_barang']; ?></td>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: right;"><?php echo number_format($row['harga_jual']); ?></td>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: center;"><?php echo number_format($row['stock']); ?></td>
                <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; border-right: 1px solid #000; text-align: right;"><?php echo number_format($subtotal); ?></td>
            </tr>
            <?php
            $i++;
        }
    }
    ?>
    </tbody>
</table>
<script>
    window.print();
    window.location = '<?php echo Url::toRoute('data-penjualan/list-persediaan-barang'); ?>';
</script>