<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\VPenjualan;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="invoice-form">

        <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'penjualan_id')->widget(
            Select2::className(),
            [
                'data' => ArrayHelper::map(VPenjualan::find()->all(), 'id', 'customerNominal')
            ]
        )
        ;
        echo $form->field($model, 'tgl')->widget(
            DatePicker::className(),
            [
                'options'       => ['placeholder' => 'Pilih Tanggal Invoice', 'value' => date('Y-m-d')],
                'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
            ]
        )
        ;
        echo $form->field($model, 'nominal')->textInput(['maxlength' => true, 'id' => 'nominal']);
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
$('#invoice-penjualan_id').change(function(){
    var strPenjualan = $('#invoice-penjualan_id > option:selected').text();
    var arrPenjualan = strPenjualan.split('/');
    var strNominal= arrPenjualan[2].replace(',','');
    $('#nominal').val(strNominal);
});
JS;
$this->registerJs($js);

