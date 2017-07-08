<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pelanggan;

/**
 * PelangganSearch represents the model behind the search form about `app\models\Pelanggan`.
 */
class PelangganSearch extends Pelanggan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nm_pelanggan', 'alamat', 'no_telp', 'barcode', 'card_number', 'tgl_bergabung', 'tipe'], 'safe'],
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
        $query = Pelanggan::find();

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
            'tgl_bergabung' => $this->tgl_bergabung,
        ]);

        $query->andFilterWhere(['like', 'nm_pelanggan', $this->nm_pelanggan])
            ->andFilterWhere(['<>', 'nm_pelanggan', '#CASH'])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'tipe', $this->tipe]);

        return $dataProvider;
    }
}
