<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenjualanDetail;

/**
 * PenjualanDetailSearch represents the model behind the search form about `app\models\PenjualanDetail`.
 */
class PenjualanDetailSearch extends PenjualanDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_penjualan', 'id_barang', 'jml'], 'integer'],
            [['harga', 'subtotal'], 'number'],
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
        $query = PenjualanDetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_penjualan' => $this->id_penjualan,
            'id_barang' => $this->id_barang,
            'jml' => $this->jml,
            'harga' => $this->harga,
            'subtotal' => $this->subtotal,
        ]);

        return $dataProvider;
    }
}
