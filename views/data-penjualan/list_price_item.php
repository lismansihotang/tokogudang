<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'List Harga Barang dengan Scan';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="barang-index">
        <h1><?php echo Html::encode($this->title) ?></h1>
        <?php
        echo Html::textInput('barcode', '', ['class' => 'form-control', 'id' => 'barcode']);
        echo Html::a(
            '<span class="glyphicon glyphicon-print"> </span> Cetak List Ini',
            Url::to('index.php?r=data-penjualan/print-list-price-item'),
            [
                'class' => 'btn btn-sm btn-success margin-top-5 margin-right-5',
                'id'    => 'modalButton'
            ]
        );
        echo Html::a(
            '<span class="glyphicon glyphicon-refresh"> </span> Buat Ulang List Ini',
            Url::to('index.php?r=data-penjualan/refresh-list-price-item'),
            [
                'class' => 'btn btn-sm btn-success margin-top-5',
                'id'    => 'modalButton'
            ]
        );
        ?>
        <br />
        <table class="table table-stripped table-hover table-bordered margin-top-15">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count(Yii::$app->session->get('arrBarang')) > 0) {
                $i = 1;
                foreach (Yii::$app->session->get('arrBarang') as $data) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['nm_barang']; ?></td>
                        <td><?php echo number_format($data['harga_jual']); ?></td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
$js = <<<JS
$('#barcode').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=data-penjualan/item-price',
           dataType:'json',
           data: {barcode: $(this).val()},
           success: function(data) {
            window.location.reload(true);
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $(this).val('');
        e.preventDefault();
    }

});
JS;
$this->registerJs($js);
