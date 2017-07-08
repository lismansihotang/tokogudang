<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Pelanggan */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="pelanggan-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nm_pelanggan')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'card_number')->textInput(
            ['maxlength' => true, 'placeholder' => 'Input atau Scan kartu anggota', 'id' => 'card_number']
        ) ?>

        <?= $form->field($model, 'tgl_bergabung')->widget(
            DatePicker::className(),
            [
                'options' => ['placeholder' => 'Pilih Tanggal Bergabung', 'value' => date('Y-m-d')],
                'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
            ]
        ) ?>

        <?= $form->field($model, 'tipe')->dropDownList(
            ['Cash' => 'Cash', 'Member' => 'Member', 'Anggota Koperasi' => 'Anggota Koperasi', 'Grosir' => 'Grosir',],
            ['prompt' => '']
        ) ?>

        <div class="form-group">
            <?= Html::submitButton(
                $model->isNewRecord ? 'Create' : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
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