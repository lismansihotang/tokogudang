<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="pelanggan-form">

        <?php $form = ActiveForm::begin();
        echo $form->field($model, 'nm_pelanggan')->textInput(['maxlength' => true]);
        echo $form->field($model, 'alamat')->textarea(['rows' => 6]);
        echo $form->field($model, 'no_telp')->textInput(['maxlength' => true]);
        echo $form->field($model, 'barcode')->textInput(['maxlength' => true]);
        echo $form->field($model, 'card_number')->textInput(
            ['maxlength' => true, 'id' => 'card_number', 'placeholder' => 'Input atau Scan No Kartu']
        );
        echo $form->field($model, 'tgl_bergabung')->widget(
            DatePicker::className(),
            [
                'options'       => ['placeholder' => 'Pilih Tanggal Bergabung', 'value' => date('Y-m-d')],
                'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
            ]
        ); ?>

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
$('#card_number').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        e.preventDefault();
    }
});
JS;
$this->registerJs($js);
