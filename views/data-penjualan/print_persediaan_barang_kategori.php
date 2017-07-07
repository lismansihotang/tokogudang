<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Persediaan Barang berdasarkan Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
    <table style="border-spacing: 0; border-top: 1px solid #000; border-right: 1px solid #000;">
        <tbody>
        <?php
        $stockCalc = 0;
        $totalCalc = 0;
        if (count($modelCalc) > 0) {
            foreach ($modelCalc as $key => $rowCalc) {
                ?>
                <tr>
                    <td style="border-bottom: 1px solid #000;border-left: 1px solid #000;"><?php echo $key; ?></td>
                    <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: right;"><?php echo number_format($rowCalc[0]['stock']); ?></td>
                    <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: right;"><?php echo number_format($rowCalc[0]['total']); ?></td>
                </tr>
                <?php
                $totalCalc += $rowCalc[0]['total'];
                $stockCalc += $rowCalc[0]['stock'];
            }
        }
        ?>
        <tr>
            <td>&nbsp;</td>
            <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: right;"><?php echo number_format($stockCalc); ?></td>
            <td style="border-bottom: 1px solid #000;border-left: 1px solid #000; text-align: right;"><?php echo number_format($totalCalc); ?></td>
        </tr>
        </tbody>
    </table>

<?php
if (count($model) > 0) {
    foreach ($model as $key => $rows) {
        $totalKategori = 0;
        $stockKategori = 0;
        echo '<h2>' . $key . '</h2>';
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
            if (count($rows) > 0) {
                $i = 1;
                foreach ($rows as $row) {
                    $subtotal = (int)$row['stock'] * (int)$row['harga_jual'];
                    $totalKategori += $subtotal;
                    $stockKategori += (int)$row['stock'];
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
        <h4><?php echo number_format($stockKategori); ?></h4>
        <h2>Rp. <?php echo number_format($totalKategori); ?></h2>
        <hr/>
        <?php
    }
}
?>
<script>
    window.print();
    window.location = '<?php echo Url::toRoute('data-penjualan/list-persediaan-barang-by-kategori'); ?>';
</script>
