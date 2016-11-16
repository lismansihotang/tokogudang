<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SatuanBesar;

/**
 * SatuanBesarSearch represents the model behind the search form about `app\models\SatuanBesar`.
 */
class SatuanBesarSearch extends SatuanBesar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'konversi_satuan'], 'integer'],
            [['nm_satuan'], 'safe'],
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
        $query = SatuanBesar::find();

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
            'konversi_satuan' => $this->konversi_satuan,
        ]);

        $query->andFilterWhere(['like', 'nm_satuan', $this->nm_satuan]);

        return $dataProvider;
    }
}
