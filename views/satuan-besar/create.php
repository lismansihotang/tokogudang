<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SatuanBesar */

$this->title = 'Create Satuan Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Satuan Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-besar-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
