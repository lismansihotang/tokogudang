<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BarangMutasiStock */
$this->title = 'Update Barang Mutasi Stock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang Mutasi Stock', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barang-mutasi-stock-update">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ); ?>

</div>
