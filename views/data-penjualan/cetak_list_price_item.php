<?php
use yii\helpers\Url;

?>
<br/>
<?php
if (count(Yii::$app->session->get('arrBarang')) > 0) {
    foreach (Yii::$app->session->get('arrBarang') as $data) {
        ?>
        <div style="width: 200px; margin-bottom: 100px;">
            <h5 style="text-align: center; font-weight: bold;"><?php echo $data['nm_barang']; ?></h5>
            <h3 style="margin-top: -5px; text-align: center; font-weight: bold;">Rp. <?php echo number_format($data['harga_jual']); ?></h3>
        </div>

        <?php
    }
}
?>
<script>
    window.print();
    window.location = '<?php echo Url::toRoute('data-penjualan/list-price-item'); ?>';
</script>