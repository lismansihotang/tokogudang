<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="pelanggan-quota-form">

        <?php $form = ActiveForm::begin();
        echo $form->field($model, 'pelanggan_id')->hiddenInput(['value' => Yii::$app->request->get('id_pelanggan')])->label(false);
        echo $form->field($model, 'nominal')->widget(
            MaskedInput::className(),
            [
                'options' => ['id' => 'nominal', 'class' => 'form-control'],
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true,
                    'removeMaskOnSubmit' => true,
                ]
            ]
        );
        ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$js = <<<JS
$(document).on('shown.bs.modal', function(e) {
  $('input:visible:enabled:first', e.target).focus();
});
JS;
$this->registerJs($js);
