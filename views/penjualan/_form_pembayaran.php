<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="penjualan-form">
        <?php $form = ActiveForm::begin();
        echo $form->field($model, 'tipe_bayar')->dropDownList(
            [
                'Cash'          => 'Cash',
                'Kartu Anggota' => 'Kartu Anggota',
                'Debet'         => 'Debet',
                'Kartu Kredit'  => 'Kartu Kredit',
            ],
            ['prompt' => '']
        )
        ;
        echo $form->field($model, 'subtotal')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias'              => 'decimal',
                    'groupSeparator'     => ',',
                    'autoGroup'          => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        )
        ;
        echo $form->field($model, 'disc')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias'              => 'decimal',
                    'groupSeparator'     => ',',
                    'autoGroup'          => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        )
        ;
        echo $form->field($model, 'total')->hiddenInput(['id' => 'penjualan-total'])->label(false);
        echo $form->field($model, 'pembayaran')->widget(
            MaskedInput::className(),
            [
                'clientOptions' => [
                    'alias'              => 'decimal',
                    'groupSeparator'     => ',',
                    'autoGroup'          => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        )
        ;
        ?>
        <h1 id="v-total"></h1>

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
        pembayaran -= total;
        $('#v-total').html(formatMoney(pembayaran));
    }else{
        $('#penjualan-total').attr('value',total);
        $('#v-total').html(formatMoney(total));
    }
});
JS;
$this->registerJs($js);
