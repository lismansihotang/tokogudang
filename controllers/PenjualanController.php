<?php
namespace app\controllers;

use Yii;
use app\models\Barang;
use app\models\BarangDetail;
use app\models\Penjualan;
use app\models\PenjualanSearch;
use app\models\PenjualanDetail;
use app\models\PelangganQuota;
use app\models\Pelanggan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * PenjualanController implements the CRUD actions for Penjualan model.
 */
class PenjualanController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'index', 'short-create'],
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
     * Lists all Penjualan models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
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
     * Displays a single Penjualan model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Penjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penjualan();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->tgl .= ' ' . date('H:i:s');
            $model->insert_date = date('Y-m-d H:i:s');
            $modelPelanggan = new Pelanggan();
            $recordPelanggan = $modelPelanggan->findOne(['id' => $model->id_pelanggan]);
            $tipePelanggan = 'Cash';
            if (count($recordPelanggan) > 0) {
                $tipePelanggan = $recordPelanggan['tipe'];
            }
            $model->tipe_pelanggan = $tipePelanggan;
            $model->save();
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['penjualan-detail/create', 'id-jual' => $model->id]);
        } else {
            return $this->render(
                'create',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionShortCreate()
    {
        $model = new Penjualan();
        $record = $model->find()->where(
            'DATE(tgl) = "' . date(
                'Y-m-d'
            ) . '" AND user_id = "' . Yii::$app->user->identity->id . '" AND pembayaran = "0" '
        )->all();
        if (count($record) > 0) {
            $idPenjualan = $record[0]->id;
        } else {
            $model->user_id = Yii::$app->user->identity->id;
            $model->tgl = date('Y-m-d H:i:s');
            $model->insert_date = date('Y-m-d H:i:s');
            $model->id_pelanggan = '1';
            $model->tipe_pelanggan = 'Cash';
            $model->save();
            $idPenjualan = $model->id;
        }
        return $this->redirect(['penjualan-detail/create', 'id-jual' => $idPenjualan]);
    }

    /**
     * Updates an existing Penjualan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPayment($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            #return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['print', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax(
                    'payment',
                    [
                        'model' => $model,
                    ]
                );
            } else {
                return $this->render(
                    'payment',
                    [
                        'model' => $model,
                    ]
                );
            }
        }
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPaymentMember($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $modelPelanggan = new Pelanggan();
            $recordPelanggan = $modelPelanggan->findOne(['card_number' => $model->card_number]);
            if ($recordPelanggan !== null) {
                $modelPelangganDetail = new PelangganQuota();
                $recordPelangganDetail = $modelPelangganDetail->findOne(['pelanggan_id' => $recordPelanggan->id]);
                if ($recordPelangganDetail !== null) {
                    $recordPelangganDetail->nominal -= $model->pembayaran;
                }
                $recordPelangganDetail->save(false);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax(
                    'payment_member',
                    [
                        'model' => $model,
                    ]
                );
            } else {
                return $this->render(
                    'payment_member',
                    [
                        'model' => $model,
                    ]
                );
            }
        }
    }

    /**
     * Deletes an existing Penjualan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ((bool)$this->findModel($id)->delete() !== false) {
            $model = new PenjualanDetail();
            $data = $model->findAll(['id_penjualan' => $id]);
            if (count($data) > 0) {
                foreach ($data as $row) {
                    # Update stock Barang
                    $modelBarang = new Barang();
                    $recordBarang = $modelBarang->findOne(['id' => $row->id_barang]);
                    if ($recordBarang !== '') {
                        $recordBarang->stock += $row->jml;
                        $recordBarang->save(false);
                    }
                    # update log
                    $logData = [
                        'id_penjualan' => $id,
                        'id_barang'    => $row->id_barang,
                        'jml'          => $row->jml,
                        'harga'        => $row->harga,
                        'subtotal'     => $row->subtotal,
                        'tgl'          => date('Y-m-d H:i:s'),
                        'user_id'      => Yii::$app->user->identity->id
                    ];
                    Yii::$app->db->createCommand()->insert(
                        'log_penjualan_delete',
                        $logData
                    )->execute();
                }
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Penjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Penjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penjualan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id
     *
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPrint($id)
    {
        /** $model = $this->findModel($id);
         * $searchModel = new PenjualanDetailSearch();
         * $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         * $dataProvider->pagination = false;
         * $dataProvider->query->where(['id_penjualan' => $id]);
         * $content = $this->renderPartial(
         * '_kwitansi',
         * [
         * 'model'        => $model,
         * 'searchModel'  => $searchModel,
         * 'dataProvider' => $dataProvider
         * ]
         * );
         * $string = 'http://localhost/ewarung/vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
         * $cssFile = file_get_contents($string);
         * $pdf = new Pdf();
         * $mpdf = $pdf->api;
         * $mpdf->SetHeader('Kwitansi');
         * $mpdf->SetFooter('{PAGENO}');
         * $mpdf->SetJS('this.print();');
         * $mpdf->WriteHtml($cssFile, 1);
         * $mpdf->WriteHtml($content, 2);
         * $mpdf->Output();
         */
        $model = $this->findModel($id);
        $modelDetail = new PenjualanDetail();
        $recordDetail = $modelDetail->findAll(['id_penjualan' => $id]);
        $modelBarang = ArrayHelper::map(Barang::find()->all(), 'id', 'nm_barang');
        return $this->renderPartial(
            '_kwitansi',
            [
                'model'       => $model,
                'modelDetail' => $recordDetail,
                'modelBarang' => $modelBarang
            ]
        );
    }

    /**
     * @return string
     */
    public function actionStock()
    {
        $model = new Barang();
        return $this->render(
            'view_stock',
            [
                'model' => $model
            ]
        );
    }

    /**
     * @return json
     */
    public function actionCheckStock()
    {
        $data = ['stock' => '0', 'harga' => '0'];
        if (Yii::$app->request->isAjax === true) {
            $modelBarangDetail = new BarangDetail();
            $recordBarangDetail = $modelBarangDetail->findOne(['barcode' => Yii::$app->request->post(('id'))]);
            if ($recordBarangDetail !== null) {
                $modelBarang = new Barang();
                $recordBarang = $modelBarang->findOne(['id' => $recordBarangDetail['id_barang']]);
                if ($recordBarang !== null) {
                    $data = ['stock' => $recordBarang['stock'], 'harga' => $recordBarang['harga_jual']];
                }
            }
        }
        echo Json::encode($data);
    }
}
