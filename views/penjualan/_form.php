<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Pelanggan;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-form">
    <?php $form = ActiveForm::begin();
    echo $form->field($model, 'tgl')->widget(
        DatePicker::className(),
        [
            'options'       => ['placeholder' => 'Pilih Tanggal Penjualan', 'value' => date('Y-m-d')],
            'pluginOptions' => ['autoClose' => true, 'format' => 'yyyy-mm-dd'],
        ]
    )
    ;
    echo $form->field($model, 'id_pelanggan')->widget(
        Select2::className(),
        [
            'data'          => ArrayHelper::map(Pelanggan::find()->all(), 'id', 'nm_pelanggan'),
            'options'       => ['placeholder' => 'Pilih Nama Pelanggan...'],
            'pluginOptions' => ['allowClear' => true],
        ]
    ) ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
