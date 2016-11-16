<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BarangMutasiStock */

$this->title = 'Create Barang Mutasi Stock';
$this->params['breadcrumbs'][] = ['label' => 'Barang Mutasi Stock', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-mutasi-stock-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
