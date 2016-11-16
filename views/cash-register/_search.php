<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CashRegisterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-register-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shift_id') ?>

    <?= $form->field($model, 'tgl') ?>

    <?= $form->field($model, 'nominal') ?>

    <?= $form->field($model, 'start_cash') ?>

    <?php // echo $form->field($model, 'finish_cash') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
