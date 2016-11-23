<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PelangganQuota */
$this->title = 'Create Pelanggan Quota';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan Quota', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggan-quota-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <?php echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ); ?>

</div>
