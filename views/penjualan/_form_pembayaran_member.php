<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;

$idJual = Yii::$app->request->get('id');
/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="penjualan-form">
        <h1 id="saldo-pelanggan"></h1>
        <?php
        echo Html::a(
            '<span class="glyphicon glyphicon-home"> </span> Kembali ke Transaksi',
            Url::to('index.php?r=penjualan-detail/create&id-jual=' . $idJual),
            [
                'class' => 'btn btn-sm btn-warning',
                'id' => 'modalButton'
            ]
        );
        $form = ActiveForm::begin(['id' => 'form_penjualan']);
        echo $form->field($model, 'tipe_bayar')->hiddenInput(['value' => 'Kartu Anggota'])->label(false);
        echo $form->field($model, 'card_number')->textInput(
            ['maxlength' => true, 'id' => 'card_number', 'placeholder' => 'Input atau Scan No Kartu']
        );
        echo $form->field($model, 'subtotal')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        );
        echo $form->field($model, 'disc')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        );
        echo $form->field($model, 'total')->hiddenInput(['id' => 'penjualan-total'])->label(false);
        echo $form->field($model, 'pembayaran')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        );
        ?>
        <h1 id="v-total"></h1>
        <input type="hidden" id="getNominal"/>

        <div class="form-group">
            <?php echo Html::submitButton(
                $model->isNewRecord ? 'Create' : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
/** Fungsi mengubah dari format number ke format money **/
function formatMoney(number){
    return number.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
}
/** Fungsi mengubah format money ke format number **/
function formatNumber(money){
    return parseFloat(money.replace(/[^\d\.]/g,''))
}
/** Deklarasi variabel **/
var total = 0;
var count = 0;
var subtotal = $('#penjualan-subtotal').val();
total = formatNumber(subtotal) ;
/** Set Maxlengh untuk input Discount **/
count = subtotal.length;
$('#penjualan-disc').attr('maxlength',parseInt(count));
/** Set Value  **/
$('#penjualan-disc').val('');
$('#penjualan-total').val(total);
$('#v-total').html(formatMoney(total));
/** update ketika input diskon **/
$('#penjualan-disc').on('change',function(){
    if($(this).val() !== ''){
        var disc = formatNumber($(this).val());
        if(disc <= 100){
            total -= (total * (disc/100));
        }else{
            total -= disc;
        }
        $('#penjualan-total').attr('value',total);
        $('#v-total').html(formatMoney(total));
    }else{
       $('#penjualan-total').attr('value',total);
       $('#v-total').html(formatMoney(total));
    }
});
/** update ketika input pembayaran **/
$('#penjualan-pembayaran').on('change',function(){

    if($(this).val() !== ''){
        var pembayaran = formatNumber($(this).val());
        var getNominal= $('#getNominal').val();
        if(parseFloat(pembayaran)>parseFloat(getNominal)){
            alert('Pembayaran yang anda input tidak sesuai dengan nominal anda...');
            $(this).val('');
            $(this).focus();
        }else{
            pembayaran -= total;
            $('#v-total').html(formatMoney(pembayaran));
        }
    }else{
        $('#penjualan-total').attr('value',total);
        $('#v-total').html(formatMoney(total));
    }
});
/** Scan Kartu Anggota **/
var getIdJual=$idJual;
$('#card_number').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
    $.ajax({
           url: '?r=pelanggan/check-card-member',
           dataType:'json',
           type:'post',
           data: {card_number: $(this).val(), id_jual: getIdJual},
           success: function(data) {
                if(data.result===false){
                    alert(data.msg);
                }else{
                    var getNominal=parseFloat(data.nominal);
                    var getSubTotal=parseFloat(data.subtotal);
                    if(getNominal<=0){
                        alert('Anda tidak memiliki saldo');
                        window.location=data.url;
                    }
                    if(getNominal<getSubTotal){
                        alert('Maaf, Nominal Anda tidak Cukup...');
                        window.location=data.url;
                    }
                    $('#getNominal').val(getNominal);
                    $('#saldo-pelanggan').html('Saldo Anda : '+formatMoney(getNominal));
                }
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        e.preventDefault();
    }
});

$('#form_penjualan').on('submit',function(e){
    if($('#card_number').val()===''){
        alert('Silahkan Isi Data Kartu member terlebih dahulu');
        $('#card_number').focus();
        e.preventDefault();
        return false;
    }
    if($('#penjualan-pembayaran').val()===''){
        alert('Silahkan Isi pembayaran terlebih dahulu');
        $('#penjualan-pembayaran').focus();
        e.preventDefault();
        return false;
    }
    if(parseFloat($('#penjualan-pembayaran').val())<=0){
        alert('Silahkan Isi pembayaran terlebih dahulu');
        $('#penjualan-pembayaran').focus();
        e.preventDefault();
        return false;
    }
    var pembayaran = $('#penjualan-pembayaran').val();
    var getNominal= $('#getNominal').val();
    if(parseFloat(pembayaran)>parseFloat(getNominal)){
        alert('Silahkan Isi pembayaran sesuai dengan nominal');
        $('#penjualan-pembayaran').focus();
        e.preventDefault();
        return false;
    }
});
JS;
$this->registerJs($js);
