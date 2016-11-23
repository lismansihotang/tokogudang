<?php
namespace app\controllers;

use Yii;
use app\models\Barang;
use app\models\BarangDetail;
use app\models\Penjualan;
use app\models\LogPenjualanDelete;
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
        # Update Penjualan
        $modelPenjualan = new Penjualan();
        $recordPenjualan = $modelPenjualan->findOne(['id' => $model->id_penjualan]);
        $recordPenjualan->subtotal = $recordPenjualan->subtotal - $model->subtotal;
        $recordPenjualan->save(false);
        # Update stock Barang
        $modelBarang = new Barang();
        $recordBarang = $modelBarang->findOne(['id' => $model->id_barang]);
        if ($recordBarang !== '') {
            $recordBarang->stock += $model->jml;
            $recordBarang->save(false);
        }
        # update log
        $modelLogBarangDelete = new LogPenjualanDelete();
        $modelLogBarangDelete->id_penjualan = $model->id_penjualan;
        $modelLogBarangDelete->id_barang = $model->id_barang;
        $modelLogBarangDelete->jml = $model->jml;
        $modelLogBarangDelete->harga = $model->harga;
        $modelLogBarangDelete->subtotal = $model->subtotal;
        $modelLogBarangDelete->tgl = date('Y-m-d H:i:s');
        $modelLogBarangDelete->user_id = Yii::$app->user->identity->id;
        $modelLogBarangDelete->save(false);
        # Hapus detail barang
        $this->findModel($id)->delete();
        return $this->redirect(['create', 'id-jual' => $model->id_penjualan]);
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
            if ($recordPenjualanDetail !== null) {
                $model = $recordPenjualanDetail;
                $model->subtotal = $recordPenjualanDetail->subtotal + ($jmlBarang * $recordBarang['harga_jual']);
                $model->jml = $recordPenjualanDetail->jml + $jmlBarang;
                $model->barcode = $getBarcode;
            } else {
                $model = $modelPenjualanDetail;
                $model->id_penjualan = Yii::$app->request->get('jual');
                $model->id_barang = $recordBarangDetail['id_barang'];
                $model->harga = $recordBarang['harga_jual'];
                $model->jml = $jmlBarang;
                $model->subtotal = $jmlBarang * $recordBarang['harga_jual'];
                $model->barcode = $getBarcode;
            }
            #update tabel barang
            if ($recordBarang->stock > $jmlBarang) {
                $recordBarang->stock -= $jmlBarang;
                #update tabel penjualan
                $recordPenjualan->subtotal += ($jmlBarang * $model->harga);
                if ($model->save(false) && $recordPenjualan->save(false) && $recordBarang->save(false)) {
                    $data = ['msg' => 'Data Berhasil di simpan', 'redirect' => true];
                } else {
                    $data = ['msg' => 'Data Gagal di simpan', 'redirect' => false];
                }
            } else {
                $data = ['msg' => 'Data Gagal di simpan. Stock Barang habis', 'redirect' => false];
            }
        }
        return Json::encode($data);
    }
}
