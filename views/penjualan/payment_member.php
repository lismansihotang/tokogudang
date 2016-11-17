<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
?>
<div class="penjualan-update">
    <?php echo $this->render(
        '_form_pembayaran_member',
        [
            'model' => $model,
        ]
    ); ?>
</div>
