<?php
use yii\helpers\Html;
use barcode\barcode\BarcodeGenerator;

$this->title = $model[0]->id_barang;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Barcode Barang #<?php echo Html::encode($this->title) ?></h1>

    <div class="btn-group margin-bottom-5">
        <?php
        echo Html::a('Home', ['view', 'id' => $model[0]->id_barang], ['class' => 'btn btn-sm btn-success']);
        echo Html::a(
            'Print',
            ['print-1-barcode', 'id' => $model[0]->id_barang, 'barcode' => $model[0]->barcode],
            ['class' => 'btn btn-sm btn-primary', 'target' => '_blank']
        ); ?>
    </div>
<?php
if (count($model) > 0) {
    foreach ($model as $row) {
        echo $row->barcode;
        echo '<div id="barcode-view-' . $row->barcode . '"></div>';
        $option = ['elementId' => 'barcode-view-' . $row->barcode, 'value' => $row->barcode, 'type' => 'ean13'];
        echo BarcodeGenerator::widget($option);
        //echo BarcodeGenerator::
    }
}
