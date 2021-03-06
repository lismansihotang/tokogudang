<?php
namespace app\controllers;

use Yii;
use app\models\BarangDetailSearch;
use app\models\Barang;
use app\models\BarangSearch;
use app\models\BarangDetail;
use app\models\LogUpdateStock;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * BarangController implements the CRUD actions for Barang model.
 */
class BarangController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'index', 'view-min-stock'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['login', 'logout'],
                        'roles'   => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Barang models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render(
            'index',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Barang model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new BarangDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $model = $this->findModel($id);
        # Update Log Stock Barang
        $logStockBarang = new LogUpdateStock();
        $logStockBarang->id_barang = $id;
        $logStockBarang->tgl = date('Y-m-d H:i:s');
        $logStockBarang->stock_awal = $model->stock;
        $logStockBarang->user_id = Yii::$app->user->identity->id;
        if (Yii::$app->request->post('hasEditable') !== null) {
            if ($model->load(Yii::$app->request->post())) {
                $logStockBarang->stock_update = $model->stock;
                $logStockBarang->save(false);
                $model->save();
                $value = $model->stock;
                $output = Json::encode(['output' => $value, 'message' => '']);
            } else {
                $output = Json::encode(['output' => '', 'message' => '']);
            }
            echo $output;
            return;
            #Yii::$app->response->redirect(Url::to(['barang/view', 'id' => Yii::$app->request->get('id')]), true);
        }
        $recordTransaksi = (new \yii\db\Query())->select('penjualan.id, penjualan.tgl, penjualan_detail.jml')
                                                ->from('penjualan')->innerJoin(
                'penjualan_detail',
                'penjualan.id=penjualan_detail.id_penjualan'
            )->where('penjualan_detail.id_barang = "' . $id . '" ')->all();
        if (Yii::$app->request->post('tgl_awal') !== '' AND Yii::$app->request->post('tgl_akhir') !== '') {
            $recordTransaksi = (new \yii\db\Query())->select('penjualan.id, penjualan.tgl, penjualan_detail.jml')
                                                    ->from('penjualan')->innerJoin(
                    'penjualan_detail',
                    'penjualan.id=penjualan_detail.id_penjualan'
                )->where(
                    'penjualan_detail.id_barang = "' . $id . '" AND (DATE(penjualan.tgl) BETWEEN "' . Yii::$app->request->post(
                        'tgl_awal'
                    ) . '" AND "' . Yii::$app->request->post('tgl_akhir') . '") '
                )->all();
        }
        return $this->render(
            'view',
            [
                'model'        => $model,
                'dataProvider' => $dataProvider,
                'transaksi'    => $recordTransaksi
            ]
        );
    }

    /**
     * Creates a new Barang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Barang();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            if ($model->margin_jual === null || (int)$model->margin_jual === 0) {
                $profit = $model->harga_jual - $model->harga_beli;
                $margin = ($profit / $model->harga_beli) * 100;
                $model->margin_jual = $margin;
            } else {
                if (strlen(round($model->harga_jual)) > 2) {
                    $pecahan = (integer)substr(round($model->harga_jual), -2);
                    if ($pecahan > 0 and $pecahan < 100) {
                        $dasarHargaJual = (integer)substr(
                                round($model->harga_jual),
                                0,
                                strlen(round($model->harga_jual)) - 2
                            ) . '00';
                        $hargaJual = $dasarHargaJual + 100;
                        $model->harga_jual = $hargaJual;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    public function actionCreateBarcode($id)
    {
        $countBarang = strlen($id);
        $rowText = '899000123123';
        $headerFormat = substr($rowText, 0, 12 - $countBarang) . $id;
        $modelDetail = new BarangDetail();
        $number = substr($headerFormat, 0, 1) + substr($headerFormat, 2, 1) + substr(
                $headerFormat,
                4,
                1
            ) + substr($headerFormat, 6, 1) + substr($headerFormat, 8, 1) + substr(
                $headerFormat,
                10,
                1
            );
        $number2 = substr($headerFormat, 1, 1) + substr($headerFormat, 3, 1) + substr($headerFormat, 5, 1) + substr(
                $headerFormat,
                7,
                1
            ) + substr($headerFormat, 9, 1) + substr($headerFormat, 11, 1);
        $totalNumber = $number + ($number2 * 3);
        $gen = substr($totalNumber, -1, 1);
        $fixNumber = 10 - $gen;
        $genNumber = $headerFormat . $fixNumber;
        $recordDetail = $modelDetail->findAll(['id_barang' => $id, 'barcode' => $genNumber]);
        if (count($recordDetail) <= 0) {
            $modelDetail->id_barang = $id;
            $modelDetail->barcode = $genNumber;
            $modelDetail->tgl = date('Y-m-d H:i:s');
            $modelDetail->save(false);
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionPrintBarcode($id)
    {
        $modelDetail = new BarangDetail();
        $recordDetail = $modelDetail->findAll(['id_barang' => $id]);
        return $this->render(
            'print_barcode',
            [
                'model' => $recordDetail,
            ]
        );
    }

    /**
     * Updates an existing Barang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->margin_jual === null || (int)$model->margin_jual === 0) {
                $profit = $model->harga_jual - $model->harga_beli;
                $margin = ($profit / $model->harga_beli) * 100;
                $model->margin_jual = $margin;
            } else {
                if (strlen(round($model->harga_jual)) > 2) {
                    $pecahan = (integer)substr(round($model->harga_jual), -2);
                    if ($pecahan > 0 and $pecahan < 100) {
                        $dasarHargaJual = (integer)substr(
                                round($model->harga_jual),
                                0,
                                strlen(round($model->harga_jual)) - 2
                            ) . '00';
                        $hargaJual = $dasarHargaJual + 100;
                        $model->harga_jual = $hargaJual;
                    }
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }

    public function actionPrint1Barcode($id, $barcode)
    {
        return $this->render('_print_barcode_1', ['id' => $id, 'barcode' => $barcode]);
    }

    /**
     * Deletes an existing Barang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Barang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Barang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Barang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return string
     */
    public function actionViewStock()
    {
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render(
            'view_stock',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Label
     */
    public function actionLabel()
    {
        $arrRecord = ArrayHelper::toArray(Barang::find()->select(['nm_barang', 'harga_jual'])->all());
        $content = $this->renderPartial(
            'label',
            [
                'model' => $arrRecord
            ]
        );
        #$string = 'http://localhost/ewarung/vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
        #$cssFile = file_get_contents($string);
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader('Cetak Label Harga');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->setCss('.box-label{width: 400px;}');
        #$mpdf->SetJS('this.print();');
        #$mpdf->WriteHtml($cssFile, 1);
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }

    /**
     * Report Barang
     */
    public function actionReport()
    {
        $modelBarang = new Barang();
        $recordBarang = $modelBarang->find()->all();
        $content = $this->renderPartial(
            'report_barang',
            [
                'model' => $recordBarang
            ]
        );
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader('Cetak List Harga Barang');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }

    /**
     * Report Stock PDF
     */
    public function actionReportStockPdf()
    {
        $modelBarang = new Barang();
        $recordBarang = $modelBarang->find()->all();
        $recordBarangDetail = ArrayHelper::map(BarangDetail::find()->all(), 'id_barang', 'barcode');
        $content = $this->renderPartial(
            'report_stock_pdf',
            [
                'model'       => $recordBarang,
                'modelDetail' => $recordBarangDetail
            ]
        );
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader('PDF Stock Barang');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }

    /**
     *
     */
    public function actionViewMinStock()
    {
        $modelBarang = new Barang();
        $recordBarang = $modelBarang->find()->where('stock < min_stock')->all();
        $content = $this->renderPartial(
            'view_min_stock',
            [
                'model' => $recordBarang
            ]
        );
        $pdf = new Pdf();
        $mpdf = $pdf->api;
        $mpdf->SetHeader('PDF Stock Barang');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->WriteHtml($content, 2);
        $mpdf->Output();
    }
}
