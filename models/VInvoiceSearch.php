<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VInvoice;

/**
 * PenjualanDetailSearch represents the model behind the search form about `app\models\PenjualanDetail`.
 */
class VInvoiceSearch extends VInvoice
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'penjualan_id'], 'integer'],
            [['nominal'], 'number'],
            [['tgl', 'desc', 'status', 'nm_pelanggan'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VInvoice::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id'           => $this->id,
                'penjualan_id' => $this->penjualan_id,
                'tgl'          => $this->tgl,
                'nominal'      => $this->nominal,
                'desc'         => $this->desc,
                'nm_pelanggan' => $this->nm_pelanggan,
            ]
        );
        return $dataProvider;
    }
}
