<?php
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Penjualan Barang';
$this->params['breadcrumbs'][] = $this->title;
$tglAwal = '';
$tglAkhir = '';
$post = Yii::$app->request->post();
if (count($post) > 0) {
    $tglAwal = $post['tgl_awal'];
    $tglAkhir = $post['tgl_akhir'];
}
?>
    <div class="barang-index">
        <h1><?php echo Html::encode($this->title) ?></h1>
        <?php
        $form = ActiveForm::begin();
        echo '<label class="control-label">Periode Laporan</label>';
        echo DatePicker::widget(
            [
                'name'          => 'tgl_awal',
                'name2'         => 'tgl_akhir',
                'attribute'     => 'tgl_awal',
                'attribute2'    => 'tgl_akhir',
                'id'            => 'tgl_awal',
                'value'         => $tglAwal,
                'value2'        => $tglAkhir,
                'options'       => ['placeholder' => 'Tgl. Awal'],
                'options2'      => ['placeholder' => 'Tgl. Akhir'],
                'type'          => DatePicker::TYPE_RANGE,
                'pluginOptions' => [
                    'format'    => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]
        );
        ?>
        <div class="form-group">
            <?php
            echo Html::submitButton(
                'Check Laporan',
                ['class' => 'btn btn-primary margin-top-5 margin-right-5']
            );
            echo Html::button(
                'Cetak Laporan Ini',
                ['class' => 'btn btn-success margin-top-5 margin-right-5', 'id' => 'cetak-laporan-2']
            );
            echo Html::button(
                'Cetak Laporan',
                ['class' => 'btn btn-success margin-top-5', 'id' => 'cetak-laporan']
            ); ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Kembali</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subtotal = 0;
            $discount = 0;
            $total = 0;
            $pembayaran = 0;
            $kembali = 0;
            if (count($model) > 0) {
                $i = 1;
                foreach ($model as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->tgl; ?></td>
                        <td class="text-right"><?php echo number_format($row->subtotal); ?></td>
                        <td class="text-right"><?php echo number_format($row->disc); ?></td>
                        <td class="text-right"><?php echo number_format($row->total); ?></td>
                        <td class="text-right"><?php echo number_format($row->pembayaran); ?></td>
                        <td class="text-right"><?php echo number_format(
                                (integer)$row->pembayaran - (integer)$row->total
                            ); ?></td>
                    </tr>
                    <?php
                    $subtotal += $row->subtotal;
                    $discount += $row->disc;
                    $total += $row->total;
                    $pembayaran += $row->pembayaran;
                    $kembali += ((integer)$row->pembayaran - (integer)$row->total);
                    $i++;
                }
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-right text-bold"><?php echo number_format($subtotal); ?></td>
                <td class="text-right text-bold"><?php echo number_format($discount); ?></td>
                <td class="text-right text-bold"><?php echo number_format($total); ?></td>
                <td class="text-right text-bold"><?php echo number_format($pembayaran); ?></td>
                <td class="text-right text-bold"><?php echo number_format($kembali); ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
<?php
$url = Url::to(['data-penjualan/index-by-pdf']);
$url2 = Url::to(['data-penjualan/index-by-pdf-2']);
$js = <<<JS

$('#cetak-laporan').click(function(){
    var tglAwal= $("#tgl_awal").val();
    var tglAkhir= $("#tgl_awal-2").val();
    if(confirm('Cetak Laporan dengan periode : '+tglAwal+' s/d '+tglAkhir)===true){
         //window.location= '$url&tgl_awal='+tglAwal+'&tgl_akhir='+tglAkhir;
         window.open('$url&tgl_awal='+tglAwal+'&tgl_akhir='+tglAkhir,'_blank');
    }
    return false;
});
$('#cetak-laporan-2').click(function(){
    var tglAwal= $("#tgl_awal").val();
    var tglAkhir= $("#tgl_awal-2").val();
    if(confirm('Cetak Laporan dengan periode : '+tglAwal+' s/d '+tglAkhir)===true){
         //window.location= '$url&tgl_awal='+tglAwal+'&tgl_akhir='+tglAkhir;
         window.open('$url2&tgl_awal='+tglAwal+'&tgl_akhir='+tglAkhir,'_blank');
    }
    return false;
});
JS;
$this->registerJs($js);

