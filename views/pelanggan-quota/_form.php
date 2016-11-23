<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelanggan-quota-form">

    <?php $form = ActiveForm::begin();
    echo $form->field($model, 'pelanggan_id')->textInput();
    echo $form->field($model, 'nominal')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
