<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\VInvoice;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="payment-form">

        <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'invoice_id')->widget(
            Select2::className(),
            [
                'data' => ArrayHelper::map(VInvoice::find()->all(), 'id', 'customerInvoice')
            ]
        )
        ;
        echo $form->field($model, 'tgl')->widget(
            DatePicker::className(),
            [
                'options'       => ['placeholder' => 'Pilih Tanggal Pembayaran', 'value' => date('Y-m-d')],
                'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
            ]
        )
        ;
        echo $form->field($model, 'nominal')->textInput(['maxlength' => true, 'id' => 'nominall']);
        echo $form->field($model, 'desc')->textarea(['rows' => 6]); ?>

        <div class="form-group">
            <?php echo Html::submitButton(
                $model->isNewRecord ? 'Create' : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$js = <<<JS
$('#payment-invoice_id').change(function(){
    var strPenjualan = $('#payment-invoice_id > option:selected').text();
    var arrPenjualan = strPenjualan.split('/');
    var strNominal= arrPenjualan[2].replace(',','');
    $('#nominal').val(strNominal);
});
JS;
$this->registerJs($js);
