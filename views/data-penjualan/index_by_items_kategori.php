<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Penjualan Barang berdasarkan Kategori';
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
            ['class' => 'btn btn-success margin-top-5 margin-right-5', 'id' => 'cetak-laporan-2']
        ); ?>
    </div>
    <?php
    ActiveForm::end();
    foreach ($model as $kategori => $values) {
        echo '<h1>' . $kategori . '</h1>';
        ?>
        <table class="table table-striped table-bordered margin-bottom-15">
            <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th class="text-center">Jml Penjualan</th>
                <th>Stock</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($model) > 0) {
                $i = 1;
                foreach ($values as $row) {
                    ?>
                    <tr>
                        <td class="width-5 text-center"><?php echo $i; ?></td>
                        <td><?php echo $row['nm_barang']; ?></td>
                        <td class="width-5 text-center"><?php echo $row['jml']; ?></td>
                        <td class="width-5 text-center"><?php echo $row['stock']; ?></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
            </tbody>
        </table>
    <?php } ?>
</div>