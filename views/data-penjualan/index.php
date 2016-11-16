<?php
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

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
        <?php echo Html::submitButton(
            'Check Laporan',
            ['class' => 'btn btn-primary margin-top-5']
        ) ?>
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
