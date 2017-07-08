<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */

$this->title = 'Create Pelanggan Saldo';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan Quotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-quota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
