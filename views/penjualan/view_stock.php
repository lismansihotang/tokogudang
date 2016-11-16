<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'View Stock';
$this->params['breadcrumbs'][] = ['label' => 'Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="penjualan-form">
        <h1><?php echo Html::encode($this->title); ?></h1>

        <p>
            <?php echo Html::a('Create Penjualan', ['create'], ['class' => 'btn btn-success']); ?>
        </p>
        <?php $form = ActiveForm::begin(['id' => 'frm-stock']);
        echo Html::label('Scan Nama Barang', 'tx-scan');
        echo Html::textInput(
            'tx-scan',
            '',
            [
                'id'          => 'tx-scan',
                'placeholder' => 'Scan Barang...',
                'class'       => 'form-control'
            ]
        );
        echo Html::label('', 'tx-stock', ['id' => 'tx-stock']);
        echo '<br/>';
        echo Html::label('', 'tx-harga', ['id' => 'tx-harga']);
        ?>

        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
/** Fungsi mengubah dari format number ke format money **/
function formatMoney(number){
    var number = parseFloat(number);
    return number.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
}
$('#tx-scan').val('');
$('#tx-scan').focus();
$('#tx-scan').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=penjualan/check-stock',
           dataType:'json',
           type:'post',
           data: {id: $(this).val()},
           success: function(data) {
                $('#tx-stock').html('<h2>Stock : '+ data.stock+' </h2>');
                $('#tx-harga').html('<h2> Harga : Rp. '+ formatMoney(data.harga)+'</h2>');
           },
           error: function(){
            alert('Error!!! Some function not run');
            }
        });
        $('#frm-stock').submit(function(){
            return false;
        });
        $(this).val('');
        e.preventDefault();
    }

});
JS;
$this->registerJs($js);
