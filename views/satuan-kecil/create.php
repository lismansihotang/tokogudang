<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SatuanKecil */

$this->title = 'Create Satuan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Satuan Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-kecil-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
