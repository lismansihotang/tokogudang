<?php
namespace app\controllers;

use Yii;
use app\models\BarangDetailSearch;
use app\models\Barang;
use app\models\BarangSearch;
use app\models\LogUpdateStock;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
            'verbs' => [
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
        return $this->render(
            'view',
            [
                'model'        => $model,
                'dataProvider' => $dataProvider
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
            if (strlen(round($model->harga_jual)) > 2) {
                $pecahan = (integer)substr(round($model->harga_jual), -2);
                if ($pecahan < 100) {
                    $dasarHargaJual = (integer)substr(
                            round($model->harga_jual),
                            0,
                            strlen(round($model->harga_jual)) - 2
                        ) . '00';
                    $hargaJual = $dasarHargaJual + 100;
                    $model->harga_jual = $hargaJual;
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
            if (strlen(round($model->harga_jual)) > 2) {
                $pecahan = (integer)substr(round($model->harga_jual), -2);
                if ($pecahan < 100) {
                    $dasarHargaJual = (integer)substr(
                            round($model->harga_jual),
                            0,
                            strlen(round($model->harga_jual)) - 2
                        ) . '00';
                    $hargaJual = $dasarHargaJual + 100;
                    $model->harga_jual = $hargaJual;
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
}
