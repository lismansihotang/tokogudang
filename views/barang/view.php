<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use barcode\barcode\BarcodeGenerator;
use kartik\editable\Editable;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$tglAwal = '';
$tglAkhir = '';
$post = Yii::$app->request->post();
if (count($post) > 0) {
    $tglAwal = $post['tgl_awal'];
    $tglAkhir = $post['tgl_akhir'];
}
?>
    <div class="row">
        <div class="col-md-6">
            <div class="barang-view">
                <h1>#<?php echo Html::encode($this->title); ?></h1>

                <div id="barcode-view"></div>
                <div class="btn-group margin-bottom-5">
                    <?php
                    echo BarcodeGenerator::widget(
                        ['elementId' => 'barcode-view', 'value' => '8990001231249', 'type' => 'ean13']
                    );
                    echo Html::a('Home', ['index'], ['class' => 'btn btn-sm btn-success']);
                    echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
                    echo Html::a(
                        'Create Barcode',
                        ['create-barcode', 'id' => $model->id],
                        ['class' => 'btn btn-sm btn-warning']
                    );
                    echo Html::a(
                        'Print Barcode',
                        ['print-barcode', 'id' => $model->id],
                        ['class' => 'btn btn-sm btn-info']
                    );
                    echo Html::a(
                        'Delete',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-sm btn-danger',
                            'data'  => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method'  => 'post',
                            ],
                        ]
                    );
                    ?>
                </div>
                <?php
                echo DetailView::widget(
                    [
                        'model'      => $model,
                        'attributes' => [
                            'id',
                            'nm_barang',
                            'ket_barang:ntext',
                            'harga_beli',
                            'margin_jual',
                            'harga_jual',
                            'satuanKecil.nm_satuan',
                            'satuanBesar.nm_satuan',
                            'kategori.desc',
                            'lokasi.desc',
                            'min_stock',
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="col-md-6">
            <span class="badge">STOCK :</span>
            <?php
            echo Editable::widget(
                [
                    'model'                => $model,
                    'attribute'            => 'stock',
                    'type'                 => 'primary',
                    'asPopover'            => false,
                    'size'                 => 'lg',
                    'inputType'            => Editable::INPUT_TEXT,
                    'editableValueOptions' => ['class' => 'text-success h3']
                ]
            );
            ?>

            <p>&nbsp;</p>

            <div class="form-group">
                <label class="label label-default" for="tx-barcode">Scan Barcode</label>
                <input type="text" id="tx-barcode" class="form-control" />
            </div>

            <?php echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns'      => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'barcode',
                        [
                            'class'    => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons'  => [
                                'delete' => function ($url, $model, $id) {
                                    return Html::a(
                                        'Delete',
                                        Url::to(['barang-detail/delete', 'id' => $id, 'model' => $model->id_barang])
                                    );
                                }
                            ]
                        ]
                    ],
                ]
            ); ?>
        </div>

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
        ?>
        <div class="col-md-12">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>Tgl</th>
                    <th>Jumlah</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($transaksi) > 0) {
                    $i = 1;
                    foreach ($transaksi as $row) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['tgl']; ?></td>
                            <td><?php echo $row['jml']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
$js = <<<JS
$('#tx-barcode').val('');
$('#tx-barcode').focus();
$('#tx-barcode').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=barang-detail/item-barcode',
           dataType:'json',
           type:'post',
           data: {barcode: $(this).val(),id_barang:$model->id},
           success: function(data) {
               if(data.redirect===false){
                    alert(data.msg);
               }else{
                    window.location.reload(data.redirect);
               }

           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $(this).val('');
        e.preventDefault();
    }

});
JS;
$this->registerJs($js);

