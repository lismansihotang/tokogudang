<?php
namespace app\controllers;

use Yii;
use app\models\Barang;
use app\models\BarangDetail;
use app\models\Penjualan;
use app\models\LogJualDetail;
use app\models\PenjualanDetail;
use app\models\PenjualanDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * PenjualanDetailController implements the CRUD actions for PenjualanDetail model.
 */
class PenjualanDetailController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PenjualanDetail models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjualanDetailSearch();
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
     * Displays a single PenjualanDetail model.
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
     * Creates a new PenjualanDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        # Basic
        $request = Yii::$app->request;
        $idJual = $request->get('id-jual');
        $searchModel = new PenjualanDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['id_penjualan' => $idJual]);
        $model = new PenjualanDetail();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render(
                'create',
                [
                    'model'        => $model,
                    'searchModel'  => $searchModel,
                    'dataProvider' => $dataProvider
                ]
            );
        }
    }

    /**
     * Updates an existing PenjualanDetail model.
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
     * Deletes an existing PenjualanDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        # Find Header penjualan
        $model = $this->findModel($id);
        $idPenjualan = $model->id_penjualan;
        $idBarang = $model->id_barang;
        $harga = $model->harga;
        $jml = $model->jml;
        $subtotal = $model->subtotal;
        # Hapus detail barang
        if ((bool)$this->findModel($id)->delete() !== false) {
            # Update Penjualan
            $modelPenjualan = new Penjualan();
            $recordPenjualan = $modelPenjualan->findOne(['id' => $idPenjualan]);
            $recordPenjualan->subtotal -= $subtotal;
            $recordPenjualan->update_date = date('Y-m-d H:i:s');
            $recordPenjualan->save(false);
            # Update stock Barang
            $modelBarang = new Barang();
            $recordBarang = $modelBarang->findOne(['id' => $idBarang]);
            if ($recordBarang !== '') {
                $recordBarang->stock += $jml;
                $recordBarang->save(false);
            }
            # update log
            $logData = [
                'id_penjualan' => $idPenjualan,
                'id_barang'    => $idBarang,
                'jml'          => $jml,
                'harga'        => $harga,
                'subtotal'     => $subtotal,
                'tgl'          => date('Y-m-d H:i:s'),
                'user_id'      => Yii::$app->user->identity->id
            ];
            Yii::$app->db->createCommand()->insert(
                'log_penjualan_delete',
                $logData
            )->execute();
            #$modelLogBarangDelete->id_penjualan = $idPenjualan;
            #$modelLogBarangDelete->id_barang = $idBarang;
            #$modelLogBarangDelete->jml = $jml;
            #$modelLogBarangDelete->harga = $harga;
            #$modelLogBarangDelete->subtotal = $subtotal;
            #$modelLogBarangDelete->tgl = date('Y-m-d H:i:s');
            #$modelLogBarangDelete->user_id = Yii::$app->user->identity->id;
            #$modelLogBarangDelete->load($logData);
            #$modelLogBarangDelete->save(false);
        }
        return $this->redirect(['create', 'id-jual' => $idPenjualan]);
    }

    /**
     * Finds the PenjualanDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return PenjualanDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenjualanDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return string
     */
    public function actionItemPrice()
    {
        $data = [];
        if (Yii::$app->request->isAjax) {
            # Get Record item id From scan barcode
            $getBarcode = Yii::$app->request->get('id');
            $barangDetail = new BarangDetail();
            $recordBarangDetail = $barangDetail->findOne(['barcode' => $getBarcode]);
            # Get Record Price from detail items
            $dataBarang = new Barang();
            $recordBarang = $dataBarang->findOne(['id' => $recordBarangDetail['id_barang']]);
            #get record from tabel Penjualan
            $modelPenjualan = new Penjualan();
            $recordPenjualan = $modelPenjualan->findOne(['id' => Yii::$app->request->get('jual')]);
            # get Record From Tabel Penjualan Detail
            $modelPenjualanDetail = new PenjualanDetail();
            $recordPenjualanDetail = $modelPenjualanDetail->findOne(
                ['id_penjualan' => Yii::$app->request->get('jual'), 'id_barang' => $recordBarangDetail['id_barang']]
            );
            # check untuk insert atau update data
            $jmlBarang = 1;
            if (Yii::$app->request->get('jml') !== null) {
                $jmlBarang = (integer)Yii::$app->request->get('jml');
            }
            # Penentuan Harga Jual Barang
            $hargaBeliBarang = $recordBarang['harga_beli'];
            $hargaJualBarang = $recordBarang['harga_jual'];
            if ($recordPenjualan->tipe_pelanggan !== 'Cash') {
                switch ($recordPenjualan->tipe_pelanggan) {
                    case 'Member':
                        $hargaJualBarang = $recordBarang['harga_jual'] - ($recordBarang['harga_jual'] * (2 / 100));
                        break;
                    case 'Anggota Koperasi';
                        $hargaJualBarang = $recordBarang['harga_jual'] - ($recordBarang['harga_jual'] * (2 / 100));
                        break;
                    case 'Grosir':
                        $hargaJualBarang = $recordBarang['harga_jual'] - ($recordBarang['harga_jual'] * (2 / 100));
                        break;
                }
            }
            $subtotalBarang = $jmlBarang * $hargaJualBarang;
            if ($recordPenjualanDetail !== null) {
                $model = $recordPenjualanDetail;
                $model->subtotal = $recordPenjualanDetail->subtotal + $subtotalBarang;
                $model->jml = $recordPenjualanDetail->jml + $jmlBarang;
                $model->barcode = $getBarcode;
            } else {
                $model = $modelPenjualanDetail;
                $model->id_penjualan = Yii::$app->request->get('jual');
                $model->id_barang = $recordBarangDetail['id_barang'];
                $model->harga = $hargaJualBarang;
                $model->jml = $jmlBarang;
                $model->subtotal = $subtotalBarang;
                $model->barcode = $getBarcode;
            }
            #update tabel barang
            if (count($recordBarang) > 0) {
                if ($recordBarang->stock >= $jmlBarang) {
                    $recordBarang->stock -= $jmlBarang;
                    #update tabel penjualan
                    $recordPenjualan->subtotal += $subtotalBarang;
                    if ($model->save(false) && $recordPenjualan->save(false) && $recordBarang->save(false)) {
                        $this->actionInsertLogPenjualanDetail(
                            [
                                'id'         => $recordPenjualan->id,
                                'tgl'        => $recordPenjualan->tgl,
                                'id_barang'  => $recordBarangDetail->id_barang,
                                'harga_beli' => $hargaBeliBarang
                            ]
                        );
                        $data = ['msg' => 'Data Berhasil di simpan', 'redirect' => true];
                    } else {
                        $data = ['msg' => 'Data Gagal di simpan', 'redirect' => false];
                    }
                } else {
                    $data = ['msg' => 'Data Gagal di simpan. Stock Barang habis', 'redirect' => false];
                }
            } else {
                $data = ['msg' => 'Data Gagal di simpan. Barang tidak ada', 'redirect' => false];
            }
        }
        return Json::encode($data);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function actionInsertLogPenjualanDetail(array $data = [])
    {
        $newLogJualDetail = new LogJualDetail();
        $newLogJualDetail->id_penjualan = $data['id'];
        $newLogJualDetail->tgl_penjualan = $data['tgl'];
        $newLogJualDetail->id_barang = $data['id_barang'];
        $newLogJualDetail->harga_beli = $data['harga_beli'];
        $newLogJualDetail->insert_date = date('Y-m-d H::i:s');
        return (bool)$newLogJualDetail->save(false);
    }
}
