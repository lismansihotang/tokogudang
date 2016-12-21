<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use barcode\barcode\BarcodeGenerator;

$this->title = $model[0]->id_barang;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Barcode Barang #<?php echo Html::encode($this->title) ?></h1>

    <div class="btn-group margin-bottom-5">
        <?php
        echo Html::a('Home', ['view', 'id' => $model[0]->id_barang], ['class' => 'btn btn-sm btn-success']);
        echo Html::a('Print', ['view', 'id' => $model[0]->id_barang], ['class' => 'btn btn-sm btn-primary']);?>
    </div>
<?php
if (count($model) > 0) {
    foreach ($model as $row) {
        echo '<div id="barcode-view-' . $row->barcode . '"></div>';
        $option = ['elementId' => 'barcode-view-' . $row->barcode, 'value' => $row->barcode, 'type' => 'ean13'];
        echo BarcodeGenerator::widget($option);
        //echo BarcodeGenerator::
    }
}
