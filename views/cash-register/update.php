<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CashRegister */

$this->title = 'Update Cash Register: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cash Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
