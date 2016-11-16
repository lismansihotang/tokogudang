<?php
namespace app\controllers;

use app\models\Penjualan;
use app\models\PenjualanSearch;
use app\models\VPenjualan;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DataPenjualanController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->searchWithDate(Yii::$app->request->post());
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
