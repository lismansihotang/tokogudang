<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SatuanKecil */

$this->title = 'Update Satuan Barang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Satuan Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="satuan-kecil-update">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
