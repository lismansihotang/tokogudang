<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Laporan Persediaan Barang berdasarkan Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <h1><?php echo Html::encode($this->title) ?></h1>
    </div>
    <div class="col-md-4">
        <?php
        echo Html::a('Cetak Laporan', ['print-list-persediaan-barang-kategori'], ['class' => 'btn btn-success margin-right-5']);
        echo Html::a('Pdf Laporan', ['pdf-list-persediaan-barang-kategori'], ['class' => 'btn btn-info']);
        ?>
    </div>
    <div class="col-md-4 pull-right text-right">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
            <?php
            $stockCalc = 0;
            $totalCalc = 0;
            if (count($modelCalc) > 0) {
                foreach ($modelCalc as $key => $rowCalc) {
                    ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo number_format($rowCalc[0]['stock']); ?></td>
                        <td><?php echo number_format($rowCalc[0]['total']); ?></td>
                    </tr>
                    <?php
                    $totalCalc += $rowCalc[0]['total'];
                    $stockCalc += $rowCalc[0]['stock'];
                }
            }
            ?>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo number_format($stockCalc); ?></td>
                <td><?php echo number_format($totalCalc); ?></td>
            </tr>
            </tbody>
        </table>

    </div>
    <div class="col-md-12">
        <?php
        if (count($model) > 0) {
            foreach ($model as $key => $rows) {
                $totalKategori = 0;
                $stockKategori = 0;
                echo '<h2>' . $key . '</h2>';
                ?>
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
                    if (count($rows) > 0) {
                        $i = 1;
                        foreach ($rows as $row) {
                            $subtotal = (int)$row['stock'] * (int)$row['harga_jual'];
                            $totalKategori += $subtotal;
                            $stockKategori += (int)$row['stock'];
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
                <h4><?php echo number_format($stockKategori); ?></h4>
                <h2>Rp. <?php echo number_format($totalKategori); ?></h2>
                <hr/>
                <?php
            }
        }
        ?>
    </div>
</div>