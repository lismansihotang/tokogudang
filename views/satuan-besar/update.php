<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SatuanBesar */
$this->title = 'Update Satuan Pembelian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Satuan Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="satuan-besar-update">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ); ?>

</div>
