<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CashRegister;

/**
 * CashRegisterSearch represents the model behind the search form about `app\models\CashRegister`.
 */
class CashRegisterSearch extends CashRegister
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shift_id'], 'integer'],
            [['tgl', 'start_cash', 'finish_cash'], 'safe'],
            [['nominal'], 'number'],
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
        $query = CashRegister::find();

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
            'shift_id' => $this->shift_id,
            'tgl' => $this->tgl,
            'nominal' => $this->nominal,
            'start_cash' => $this->start_cash,
            'finish_cash' => $this->finish_cash,
        ]);

        return $dataProvider;
    }
}
