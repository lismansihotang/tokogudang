<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PelangganQuota;

/**
 * PelangganQuotaSearch represents the model behind the search form about `app\models\PelangganQuota`.
 */
class PelangganQuotaSearch extends PelangganQuota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pelanggan_id', 'user_insert', 'user_update'], 'integer'],
            [['nominal'], 'number'],
            [['insert_date', 'update_date'], 'safe'],
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
        $query = PelangganQuota::find();

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
            'pelanggan_id' => $this->pelanggan_id,
            'nominal' => $this->nominal,
            'user_insert' => $this->user_insert,
            'insert_date' => $this->insert_date,
            'user_update' => $this->user_update,
            'update_date' => $this->update_date,
        ]);

        return $dataProvider;
    }
}
