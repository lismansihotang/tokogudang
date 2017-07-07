<?php

namespace app\controllers;

use Yii;
use app\models\Pelanggan;
use app\models\PelangganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PelangganQuota;
use app\models\Penjualan;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * PelangganController implements the CRUD actions for Pelanggan model.
 */
class PelangganController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pelanggan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PelangganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelanggan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pelanggan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pelanggan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pelanggan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pelanggan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pelanggan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelanggan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelanggan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     */
    public function actionCheckCardMember()
    {
        $data = [
            'result'  => false,
            'msg'     => 'No. Kartu ini tidak teregistrasi dalam sistem',
            'nominal' => '0',
            'url'     => '',
            'subtotal'   => '0'
        ];
        if (Yii::$app->request->isAjax === true) {
            $modelPelanggan = new Pelanggan();
            $recordPelanggan = $modelPelanggan->findOne(['card_number' => Yii::$app->request->post('card_number')]);
            if ($recordPelanggan !== null) {
                $modelPelangganDetail = new PelangganQuota();
                $recordPelangganDetail = $modelPelangganDetail->findOne(['pelanggan_id' => $recordPelanggan->id]);
                $nominal = 0;
                $url = Url::to('index.php?r=penjualan-detail/create&id-jual=' . Yii::$app->request->post('id_jual'));
                if ($recordPelangganDetail !== null) {
                    $nominal = $recordPelangganDetail->nominal;
                }
                $modelPenjualan = new Penjualan();
                $recordPenjualan = $modelPenjualan->findOne(['id' => Yii::$app->request->post('id_jual')]);
                $subtotal = 0;
                if ($recordPenjualan !== null) {
                    $subtotal = $recordPenjualan->subtotal;
                }
                $data = [
                    'result'  => true,
                    'msg'     => 'No. Kartu ini teregistrasi dalam sistem',
                    'nominal' => $nominal,
                    'url'     => $url,
                    'subtotal'   => $subtotal
                ];
            }
        }
        echo Json::encode($data);
    }
}
