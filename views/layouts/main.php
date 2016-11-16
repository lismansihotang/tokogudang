<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags(); ?>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => Html::img(
                    '@web/images/logo-3.png',
                    ['alt' => Yii::$app->name]
                ) . ' e-Warung <small><kbd>POS</kbd></small>',
            'brandUrl'   => Yii::$app->homeUrl,
            'options'    => [
                'class' => 'navbar-default navbar-fixed-top',
            ],
        ]
    );
    if (Yii::$app->user->isGuest === true) {
        echo Nav::widget(
            [
                'encodeLabels' => false,
                'options'      => ['class' => 'navbar-nav navbar-right'],
                'items'        => [
                    ['label' => '<span class="glyphicon glyphicon-home"> </span> Home', 'url' => ['/site/index']],
                    ['label' => '<span class="glyphicon glyphicon-log-in"> </span> Login', 'url' => ['/site/login']]
                ]
            ]
        );
    } else {
        echo Nav::widget(
            [
                'encodeLabels' => false,
                'options'      => ['class' => 'navbar-nav navbar-right'],
                'items'        => [
                    ['label' => '<span class="glyphicon glyphicon-home"> </span> Home', 'url' => ['/site/index']],
                    [
                        'label' => '<span class="glyphicon glyphicon-shopping-cart"> </span> Transaksi',
                        'items' => [
                            ['label' => 'Penjualan', 'url' => ['penjualan/index']],
                            '<li class="divider"></li>',
                            ['label' => 'Mutasi Stock', 'url' => ['barang-mutasi-stock/index']],
                        ],
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-th"> </span> Laporan',
                        'items' => [
                            ['label' => 'Data Penjualan', 'url' => ['data-penjualan/index']],
                            ['label' => 'List Stock Barang', 'url' => ['barang/view-stock']],
                            ['label' => 'Mutasi Stock', 'url' => ['lap-mutasi-stock/index']],
                            '<li class="divider"></li>',
                            ['label' => 'Summary', 'url' => ['lap-summary/index']]
                        ],
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-wrench"> </span> Master Data',
                        'items' => [
                            ['label' => 'Barang', 'url' => ['barang/index']],
                            '<li class="divider"></li>',
                            ['label' => 'Kategori', 'url' => ['kategori/index']],
                            ['label' => 'Lokasi', 'url' => ['lokasi/index']],
                            '<li class="divider"></li>',
                            ['label' => 'Satuan Barang', 'url' => ['satuan-kecil/index']],
                            ['label' => 'Satuan Pembelian', 'url' => ['satuan-besar/index']],
                            '<li class="divider"></li>',
                            ['label' => 'Pengguna', 'url' => ['sys-user/index']],
                        ],
                    ],
                    [
                        'label' => '<span class="glyphicon glyphicon-log-out"> </span> Logout(' . Yii::$app->user->identity->username . ')',
                        'url'   => ['/site/logout']
                    ]
                ],
            ]
        );
    }
    NavBar::end();
    ?>
    <div class="container">
        <?php echo Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ); ?>
        <?php
        echo $content; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; e-Warung <?php echo date('Y'); ?></p>

        <p class="pull-right"><?php Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
