<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Persediaan Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <h1><?php echo Html::encode($this->title) ?></h1>
    </div>
    <div class="col-md-4">
        <?php
        echo Html::a('Cetak Laporan', ['print-list-persediaan-barang'], ['class' => 'btn btn-success margin-right-5']);
        echo Html::a('Pdf Laporan', ['pdf-list-persediaan-barang'], ['class' => 'btn btn-info']);
        ?>
    </div>
    <div class="col-md-4 pull-right text-right">
        <?php
        if (count($modelCalc) > 0) {
            echo '<h1>Rp. ' . number_format($modelCalc[0]['total']) . '</h1>';
            echo '<h3>' . number_format($modelCalc[0]['stock']) . '</h3>';
        }
        ?>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalStock = 0;
            $total = 0;
            if (count($model) > 0) {
                $i = 1;
                foreach ($model as $row) {
                    $subtotal = $row['stock'] * $row['harga_jual'];
                    $totalStock += $row['stock'];
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td class="text-center width-5"><?php echo $i; ?></td>
                        <td><?php echo $row['nm_barang']; ?></td>
                        <td class="text-right width-5"><?php echo number_format($row['harga_jual']); ?></td>
                        <td class="text-center width-5"><?php echo number_format($row['stock']); ?></td>
                        <td class="text-right width-5"><?php echo number_format($subtotal); ?></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
            </tbody>
        </table>
        <h3><?php echo number_format($totalStock); ?></h3>

        <h1>Rp. <?php echo number_format($total); ?></h1>
    </div>
</div>