<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penjualan;
use app\models\VPenjualanCustom;
use kartik\mpdf\Pdf;

class DataPenjualanController extends Controller
{

    public function actionIndex()
    {
        $model = new Penjualan();
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) = "' . $dateFrom . '" ';
        } else {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '" ';
        }
        $record = $model->findBySql($sqlString)->all();
        return $this->render('index', ['model' => $record]);
    }

    public function actionIndexByPdf2()
    {
        $arrDataPenjualan = null;
        $modelPenjualan = new VPenjualanCustom();
        $dateFrom = Yii::$app->request->get('tgl_awal');
        $dateTo = Yii::$app->request->get('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) = "' . $dateFrom . '" ';
        } else {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '" ';
        }
        $recordPenjualan = $modelPenjualan->findBySql($sqlString)->all();
        if ($recordPenjualan !== null) {
            $arrDataPenjualan = $recordPenjualan;
        }
        $content = $this->renderPartial('index_by_pdf_2', ['model' => $arrDataPenjualan]);
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
            30, // margin top
            10, // margin bottom
            18, // margin header
            12
        );
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }

    public function actionIndexByPdf()
    {
        $arrDataPenjualan = null;
        $modelPenjualan = new VPenjualanCustom();
        $dateFrom = Yii::$app->request->get('tgl_awal');
        $dateTo = Yii::$app->request->get('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $sqlString = 'SELECT * FROM v_penjualan_custom WHERE DATE(tgl) = "' . $dateFrom . '" ';
        } else {
            $sqlString = 'SELECT * FROM v_penjualan_custom WHERE DATE(tgl) BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '" ';
        }
        $recordPenjualan = $modelPenjualan->findBySql($sqlString)->all();
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
            30, // margin top
            10, // margin bottom
            18, // margin header
            12
        );
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }
}
