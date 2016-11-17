<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="barang-index">
        <h1><?php echo Html::encode($this->title) ?></h1>
        <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?php echo Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']); ?>
            <?php echo Html::a(
                'Cetak Label Harga Barang',
                ['label'],
                ['class' => 'btn btn-warning', 'target' => '_blank']
            ); ?>
            <input type="text"
                   name="tx-barcode"
                   id="tx-barcode"
                   placeholder="Scan untuk mencari barang"
                   class="form-control margin-top-5" />
        </p>
        <?php echo GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'nm_barang',
                    'harga_jual:decimal',
                    'min_stock',
                    'stock:integer',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]
        ); ?>
    </div>
<?php
$js = <<<JS
$('#tx-barcode').val('');
$('#tx-barcode').focus();
$('#tx-barcode').keypress(function(e){
    var key = e.which || e.ctrlKey;
    if(key === 13){
        $.ajax({
           url: '?r=barang-detail/search-by-barcode',
           dataType:'json',
           type:'post',
           data: {barcode: $(this).val()},
           success: function(data) {
               if(data.result===true){
                    window.location = data.msg;
               }else{
                    alert(data.msg);
               }

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
