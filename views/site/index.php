<?php
use kartik\icons\Icon;
use yii\helpers\Url;

Icon::map($this);
/* @var $this yii\web\View */
$this->title = 'e-Warung POS';
?>
    <div class="site-index">

        <div class="body-content">
            <div class="row margin-top-35">
                <div class="col-md-2">
                    <a class="btn btn-success" href="<?php echo Url::toRoute('penjualan/short-create'); ?>">
                        <?php echo Icon::show('opencart', ['class' => 'fa-3x'], Icon::FA); ?>
                        <br>
                        Mulai Transaksi
                        <h3><?php
                            echo $modelPenjualan;
                            ?> Transaksi
                        </h3>
                    </a>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-info" href="<?php echo Url::toRoute('barang/view-min-stock'); ?>" target="_blank">
                        <?php echo Icon::show('question-circle', ['class' => 'fa-3x'], Icon::FA); ?>
                        <br>
                        Minimal Stock
                        <h3><?php
                            echo $modelBarang;
                            ?> Barang
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <h1>Selamat Datang!</h1>

            <p class="lead">Aplikasi e-Warung berbasis Web.</p>
        </div>
    </div>
<?php
#echo Yii::$app->timeZone;
#shell_exec('D:/CashDrawer/run.exe');