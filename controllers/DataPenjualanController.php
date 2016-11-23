<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PenjualanSearch;
use app\models\VPenjualanCustom;
use kartik\mpdf\Pdf;

class DataPenjualanController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->searchWithDate(Yii::$app->request->post());
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionIndexByPdf()
    {
        $arrDataPenjualan = null;
        $modelPenjualan = new VPenjualanCustom();
        $recordPenjualan = $modelPenjualan->findBySql(
            'SELECT * FROM v_penjualan_custom WHERE DATE(tgl) BETWEEN "' . Yii::$app->request->get(
                'tgl_awal'
            ) . '" AND "' . Yii::$app->request->get('tgl_akhir')
            . '"'
        )->all();
        if ($recordPenjualan !== null) {
            $arrDataPenjualan = $recordPenjualan;
        }
        $content = $this->renderPartial('index_by_pdf', ['data' => $arrDataPenjualan]);
        #return $content;
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader('Laporan Penjualan Barang');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }
}
