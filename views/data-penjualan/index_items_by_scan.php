<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'List Barang by Scan';
$this->params['breadcrumbs'][] = $this->title;
echo '<h1>' . Html::encode($this->title) . '</h1>';
echo Html::textInput('tx_scan', '', ['class' => 'form-control']);