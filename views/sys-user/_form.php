<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-user-form">

    <?php
    $form = ActiveForm::begin();
    echo $form->field($model, 'username')->textInput(['maxlength' => true]);
    echo $form->field($model, 'pass')->passwordInput(['maxlength' => true]);
    echo $form->field($model, 'fullname')->textInput(['maxlength' => true]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
