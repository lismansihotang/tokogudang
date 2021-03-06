<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Penjualan;
use yii\bootstrap\Modal;

$request = Yii::$app->request;
$idJual = $request->get('id-jual');
/* @var $this yii\web\View */
/* @var $model app\models\PenjualanDetail */
/* @var $form yii\widgets\ActiveForm */
$modelPenjualan = new Penjualan();
$record = $modelPenjualan->findOne(['id' => $idJual]);
$subtotal = 0;
$pembayaran = 0;
if ($record !== null) {
    $subtotal = $record->subtotal;
    $pembayaran = $record->pembayaran;
}
if ($pembayaran > 0) {
    echo '<meta http-equiv="refresh" content="0; url=' . Url::toRoute(['penjualan/view', 'id' => $idJual]) . '" />';
}
Modal::begin(
    [
        'header' => '<h3>Pembayaran</h3>',
        'id'     => 'modal',
        'size'   => 'modal-md'
    ]
);
echo '<div id="modalContent"></div>';
Modal::end();
?>
    <div class="pull-right margin-bottom-lg">
        <?php
        echo Html::button(
            '<span class="glyphicon glyphicon-shopping-cart"> </span> Pembayaran',
            [
                'value' => Url::to('index.php?r=penjualan/payment&id=' . $idJual),
                'class' => 'btn btn-sm btn-success margin-right-5',
                'id'    => 'modalButton'
            ]
        );
        echo Html::a(
            '<span class="glyphicon glyphicon-credit-card"> </span> Pembayaran Member',
            Url::to('index.php?r=penjualan/payment-member&id=' . $idJual),
            [
                'class' => 'btn btn-sm btn-warning',
                'id'    => 'modalButton'
            ]
        );
        ?>
    </div>
    <div class="penjualan-detail-form">
        <h1><?php
            echo number_format($subtotal);
            ?>
        </h1>
        <?php
        $form = ActiveForm::begin(['id' => 'frm-penjualan']);
        echo $form->field($model, 'id_barang')->textInput(
            ['id' => 'id-barang', 'placeholder' => 'Input atau Scan Barang']
        );
        ?>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
$('#id-barang').val('');
$('#id-barang').focus();
$('#id-barang').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        var qtyItem = prompt('Isi Jumlah Pembelian Barang','1');
        if(qtyItem !== null){
            $.ajax({
               url: '?r=penjualan-detail/item-price',
               dataType:'json',
               data: {id: $(this).val(),jual:$idJual,jml:qtyItem},
               success: function(data) {
                   if(data.redirect===false){
                        alert(data.msg);
                   }
                   window.location.reload(data.redirect);
               },
               error: function(){
                alert('Error!!! Some function not run');
                }
            });
            $('#frm-penjualan').submit(function(){
                return false;
            });
            $(this).val('');
            e.preventDefault();
        }
    }

});
JS;
$this->registerJs($js);

