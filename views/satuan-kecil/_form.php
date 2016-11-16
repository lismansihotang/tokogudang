<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SatuanKecil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satuan-kecil-form">

    <?php
    $form = ActiveForm::begin();
    echo $form->field($model, 'nm_satuan')->textInput(['maxlength' => true]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
