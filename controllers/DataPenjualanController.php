<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penjualan;
use app\models\VPenjualanCustom;
use kartik\mpdf\Pdf;

/**
 * Class DataPenjualanController
 *
 * @package app\controllers
 */
class DataPenjualanController extends Controller
{

    /**
     * @return string
     */
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

    /**
     *
     */
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
            'P', // L - landscape, P - portrait
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

    /**
     *
     */
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

    /**
     * @return string
     */
    public function actionIndexItems()
    {
        $modelPenjualan = new Penjualan();
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $idBarang = Yii::$app->request->post('id_barang');
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
        $arrDataPenjualan = '';
        if ($recordPenjualan !== null) {
            foreach ($recordPenjualan as $row) {
                if ($arrDataPenjualan !== '') {
                    $arrDataPenjualan .= ', "' . $row->id . '"';
                } else {
                    $arrDataPenjualan .= '"' . $row->id . '"';
                }
            }
        }
        $model = null;
        if ($arrDataPenjualan !== '') {
            if ($idBarang !== '') {
                $model = (new \yii\db\Query())->select(
                    'COUNT(penjualan_detail.id) AS jml, id_barang, barang.nm_barang AS nm_barang'
                )->from(
                    'penjualan_detail'
                )->innerJoin('barang', 'penjualan_detail.id_barang=barang.id')->where(
                    'id_penjualan IN (' . $arrDataPenjualan . ') AND penjualan_detail.id_barang="' . $idBarang . '"'
                )->groupBy('id_barang')->orderBy('COUNT(penjualan_detail.id) DESC')->all();
            } else {
                $model = (new \yii\db\Query())->select(
                    'COUNT(penjualan_detail.id) AS jml, id_barang, barang.nm_barang AS nm_barang'
                )->from(
                    'penjualan_detail'
                )->innerJoin('barang', 'penjualan_detail.id_barang=barang.id')->where(
                    'id_penjualan IN (' . $arrDataPenjualan . ')'
                )->groupBy('id_barang')->orderBy('COUNT(penjualan_detail.id) DESC')->all();
            }
        }
        return $this->render('index_by_items', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionIndexItemsKategori()
    {
        $modelPenjualan = new Penjualan();
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
        $recordPenjualan = $modelPenjualan->findBySql($sqlString)->all();
        $arrDataPenjualan = '';
        if ($recordPenjualan !== null) {
            foreach ($recordPenjualan as $row) {
                if ($arrDataPenjualan !== '') {
                    $arrDataPenjualan .= ', "' . $row->id . '"';
                } else {
                    $arrDataPenjualan .= '"' . $row->id . '"';
                }
            }
        }
        $model = [];
        if ($arrDataPenjualan !== '') {
            $model = (new \yii\db\Query())->select(
                'SUM(penjualan_detail.jml) AS jml, id_barang, barang.nm_barang AS nm_barang, barang.id_kategori AS id_kategori, barang.stock AS stock'
            )
                ->from(
                    'penjualan_detail'
                )
                ->innerJoin('barang', 'penjualan_detail.id_barang=barang.id')->where(
                    'id_penjualan IN (' . $arrDataPenjualan . ')'
                )
                ->groupBy('barang.id_kategori, penjualan_detail.id_barang')
                ->orderBy('COUNT(penjualan_detail.id) DESC')
                ->all();
        }
        $modelKategori = new \app\models\Kategori();
        $recordKategori = $modelKategori->find()->orderBy('desc')->all();
        $arrData = [];
        if (count($recordKategori) > 0 and count($model) > 0) {
            foreach ($recordKategori as $kategori) {
                foreach ($model as $row) {
                    if ((integer)$row['id_kategori'] === (integer)$kategori['id']) {
                        $arrData[$kategori['desc']][] = [
                            'id_barang' => $row['id_barang'],
                            'nm_barang' => $row['nm_barang'],
                            'id_kategori' => $row['id_kategori'],
                            'jml' => $row['jml'],
                            'stock' => $row['stock']
                        ];
                    }
                }
            }
        }
        return $this->render('index_by_items_kategori', ['model' => $arrData]);
    }

    /**
     * @return string
     */
    public function actionListItemsByScan()
    {
        return $this->render('index_items_by_scan');
    }

    /**
     * @return string
     */
    public function actionIndexItemsUser()
    {
        $modelPenjualan = new Penjualan();
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $idUser = Yii::$app->request->post('id_user');
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
        if ($idUser !== '') {
            $sqlString .= ' AND user_id="' . $idUser . '" ';
        }
        $recordPenjualan = $modelPenjualan->findBySql($sqlString)->all();
        $arrDataPenjualan = '';
        if ($recordPenjualan !== null) {
            foreach ($recordPenjualan as $row) {
                if ($arrDataPenjualan !== '') {
                    $arrDataPenjualan .= ', "' . $row->id . '"';
                } else {
                    $arrDataPenjualan .= '"' . $row->id . '"';
                }
            }
        }
        $model = null;
        if ($arrDataPenjualan !== '') {
            $model = (new \yii\db\Query())->select(
                'COUNT(penjualan_detail.id) AS jml, id_barang, barang.nm_barang AS nm_barang'
            )->from(
                'penjualan_detail'
            )->innerJoin('barang', 'penjualan_detail.id_barang=barang.id')->where(
                'id_penjualan IN (' . $arrDataPenjualan . ')'
            )->groupBy('id_barang')->orderBy('COUNT(penjualan_detail.id) DESC')->all();
        }
        return $this->render('index_by_user', ['model' => $model]);
    }

    /**
     * @return string
     */
    public function actionIndexPenjualanUser()
    {
        $model = new Penjualan();
        $dateFrom = Yii::$app->request->post('tgl_awal');
        $dateTo = Yii::$app->request->post('tgl_akhir');
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $idUser = Yii::$app->request->post('id_user');
        $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
        $dateCreatedTo = new \DateTime($dateTo, $timezone);
        $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
        $diffDay = (integer)$intervalDay->format('%a');
        if ($diffDay === 0) {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) = "' . $dateFrom . '" ';
        } else {
            $sqlString = 'SELECT * FROM penjualan WHERE DATE(tgl) BETWEEN "' . $dateFrom . '" AND "' . $dateTo . '" ';
        }
        if ($idUser !== '') {
            $sqlString .= ' AND user_id="' . $idUser . '" ';
        }
        $record = $model->findBySql($sqlString)->all();
        return $this->render('index_penjualan_by_user', ['model' => $record]);
    }

    /**
     * @return string
     */
    public function actionListPriceItem()
    {
        return $this->render('list_price_item');
    }

    /**
     * @return string
     */
    public function actionItemPrice()
    {
        $data = [];
        if (Yii::$app->request->isAjax) {
            $model = (new \yii\db\Query())->select('barang.id, barang.nm_barang, barang.harga_jual')
                ->from('barang_detail')
                ->innerJoin(
                    'barang',
                    'barang_detail.id_barang=barang.id'
                )
                ->where(['barang_detail.barcode' => Yii::$app->request->get('barcode')])
                ->one();
            if (count($model) > 0) {
                if (count(Yii::$app->session->get('arrBarang')) > 0) {
                    $arrBarang = array_merge(Yii::$app->session->get('arrBarang'), [$model]);
                    Yii::$app->session->set('arrBarang', $arrBarang);
                } else {
                    Yii::$app->session->set('arrBarang', [$model]);
                }
                $data = $model;
            }
        }
        return \yii\helpers\Json::encode($data);
    }

    /**
     * @return string
     */
    public function actionRefreshListPriceItem()
    {
        Yii::$app->session->set('arrBarang', []);
        return $this->render('list_price_item');
    }

    /**
     * @return string
     */
    public function actionPrintListPriceItem()
    {
        return $this->render('cetak_list_price_item');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionListPersediaanBarang()
    {
        $model = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        $modelCalc = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        return $this->render('index_persediaan_barang', ['model' => $model, 'modelCalc' => $modelCalc]);
    }

    /**
     * @return string
     */
    public function actionListPersediaanBarangByKategori()
    {
        $model = [];
        $modelCalc = [];
        $modelKategori = (new \yii\db\Query())->from('kategori')->orderBy('desc')->all();
        if (count($modelKategori) > 0) {
            foreach ($modelKategori as $row) {
                $model[$row['desc']] = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
                $modelCalc[$row['desc']] = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
            }
        }
        return $this->render('index_persediaan_barang_kategori', ['model' => $model, 'modelCalc' => $modelCalc]);
    }

    /**
     * @return string
     */
    public function actionPrintListPersediaanBarangKategori()
    {
        $model = [];
        $modelCalc = [];
        $modelKategori = (new \yii\db\Query())->from('kategori')->orderBy('desc')->all();
        if (count($modelKategori) > 0) {
            foreach ($modelKategori as $row) {
                $model[$row['desc']] = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
                $modelCalc[$row['desc']] = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
            }
        }
        return $this->renderPartial('print_persediaan_barang_kategori', ['model' => $model, 'modelCalc' => $modelCalc]);
    }

    /**
     *
     */
    public function actionPdfListPersediaanBarangKategori()
    {
        $model = [];
        $modelCalc = [];
        $modelKategori = (new \yii\db\Query())->from('kategori')->orderBy('desc')->all();
        if (count($modelKategori) > 0) {
            foreach ($modelKategori as $row) {
                $model[$row['desc']] = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
                $modelCalc[$row['desc']] = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0 AND id_kategori="' . $row['id'] . '"')->orderBy('nm_barang ASC')->all();
            }
        }
        $content = $this->renderPartial('print_persediaan_barang_kategori', ['model' => $model, 'modelCalc' => $modelCalc]);
        #return $content;
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader(
            'Laporan Persediaan Barang '
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

    /**
     * @return string
     */
    public function actionPrintListPersediaanBarang()
    {
        $model = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        $modelCalc = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        return $this->renderPartial('print_persediaan_barang', ['model' => $model, 'modelCalc' => $modelCalc]);
    }

    /**
     *
     */
    public function actionPdfListPersediaanBarang()
    {
        $model = (new \yii\db\Query())->select('nm_barang, harga_jual, stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        $modelCalc = (new \yii\db\Query())->select('SUM(harga_jual*stock) AS total, SUM(stock) AS stock')->from('barang')->where('stock > 0')->orderBy('nm_barang ASC')->all();
        $content = $this->renderPartial('print_persediaan_barang', ['model' => $model, 'modelCalc' => $modelCalc]);
        #return $content;
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader(
            'Laporan Persediaan Barang '
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
