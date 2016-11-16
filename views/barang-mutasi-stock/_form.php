<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Barang;

/* @var $this yii\web\View */
/* @var $model app\models\BarangMutasiStock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-mutasi-stock-form">
    <?php
    $form = ActiveForm::begin();
    echo $form->field($model, 'tgl')->widget(
        DatePicker::className(),
        [
            'options'       => ['placeholder' => 'Pilih Tanggal Penjualan', 'value' => date('Y-m-d')],
            'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
        ]
    )
    ;
    echo $form->field($model, 'id_barang')->widget(
        Select2::className(),
        [
            'data'          => ArrayHelper::map(Barang::find()->all(), 'id', 'nm_barang'),
            'options'       => ['placeholder' => 'Pilih Barang...'],
            'pluginOptions' => ['allowClear' => true],
        ]
    )
    ;
    echo $form->field($model, 'stock')->textInput();
    //echo $form->field($model, 'harga')->textInput(['maxlength' => true]);
    echo $form->field($model, 'keterangan')->textarea(['rows' => 6]);
    ?>
    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
