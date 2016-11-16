<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CashRegister */

$this->title = 'Create Cash Register';
$this->params['breadcrumbs'][] = ['label' => 'Cash Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-register-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
