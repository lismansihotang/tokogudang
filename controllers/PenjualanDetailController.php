<?php
namespace app\controllers;

use app\models\Barang;
use app\models\BarangDetail;
use app\models\Penjualan;
use Yii;
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
        $modelPenjualan = new Penjualan();
        $recordPenjualan = $modelPenjualan->findOne(['id' => $model->id_penjualan]);
        $recordPenjualan->subtotal = $recordPenjualan->subtotal - $model->subtotal;
        $recordPenjualan->save(false);
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
            $barangDetail = new BarangDetail();
            $recordBarangDetail = $barangDetail->findOne(['barcode' => Yii::$app->request->get('id')]);
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
            if ($recordPenjualanDetail !== null) {
                $model = $recordPenjualanDetail;
                $model->subtotal = $recordPenjualanDetail->subtotal + $recordBarang['harga_jual'];
                $model->jml = $recordPenjualanDetail->jml + 1;
            } else {
                $model = $modelPenjualanDetail;
                $model->id_penjualan = Yii::$app->request->get('jual');
                $model->id_barang = $recordBarangDetail['id_barang'];
                $model->harga = $recordBarang['harga_jual'];
                $model->subtotal = $recordBarang['harga_jual'];
            }
            #update tabel barang
            if ($recordBarang->stock > 1) {
                $recordBarang->stock -= 1;
                #update tabel penjualan
                $recordPenjualan->subtotal += $model->harga;
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
