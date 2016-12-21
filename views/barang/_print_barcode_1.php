<?php
use yii\helpers\Html;
use barcode\barcode\BarcodeGenerator;
use yii\helpers\Url;
?>

<script>
    window.print();
</script>
<?php
echo '<div id="print-barcode"></div>';
$option = ['elementId' => 'print-barcode', 'value' => $barcode, 'type' => 'ean13'];
echo BarcodeGenerator::widget($option);