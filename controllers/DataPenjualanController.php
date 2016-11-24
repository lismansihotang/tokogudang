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
        $mpdf->SetHeader(
            'Laporan Penjualan Barang : ' . Yii::$app->request->get(
                'tgl_awal'
            ) . ' s/d ' . Yii::$app->request->get(
                'tgl_akhir'
            )
        );
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->AddPage(
            'L', // L - landscape, P - portrait
            '',
            '',
            '',
            '',
            10, // margin_left
            10, // margin right
            10, // margin top
            10, // margin bottom
            18, // margin header
            12
        );
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }
}
