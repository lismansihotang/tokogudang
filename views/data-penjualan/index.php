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
                'Cetak Laporan',
                ['class' => 'btn btn-success margin-top-5', 'id' => 'cetak-laporan']
            ); ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
        <?php echo GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
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
<?php
$url = Url::to(['data-penjualan/index-by-pdf']);
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
JS;
$this->registerJs($js);

