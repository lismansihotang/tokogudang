<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */
$this->title = 'Update Pelanggan Quota: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan Quota', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelanggan-quota-update">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ); ?>

</div>