<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penjualan;

/**
 * PenjualanSearch represents the model behind the search form about `app\models\Penjualan`.
 */
class PenjualanSearch extends Penjualan
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pelanggan'], 'integer'],
            [['tgl', 'tipe_bayar'], 'safe'],
            [['subtotal', 'disc', 'pajak', 'total', 'pembayaran'], 'number'],
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
        $query = Penjualan::find();
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
                'tgl'          => $this->tgl,
                'id_pelanggan' => $this->id_pelanggan,
                'subtotal'     => $this->subtotal,
                'disc'         => $this->disc,
                'pajak'        => $this->pajak,
                'total'        => $this->total,
                'pembayaran'   => $this->pembayaran,
            ]
        );
        $query->andFilterWhere(['like', 'tipe_bayar', $this->tipe_bayar]);
        return $dataProvider;
    }

    public function searchWithDate($params)
    {
        $query = Penjualan::find();
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
        if (count($params) > 0) {
            $arrKey = array_keys($params);
            $dateFrom = $params[$arrKey[1]];
            $dateTo = $params[$arrKey[2]];
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateCreatedFrom = new \DateTime($dateFrom, $timezone);
            $dateCreatedTo = new \DateTime($dateTo, $timezone);
            $intervalDay = $dateCreatedFrom->diff($dateCreatedTo);
            $diffDay = (integer)$intervalDay->format('%a');
            if ($diffDay === 0) {
                $query->filterWhere(['DATE(tgl)' => $dateFrom]);
            } else {
                $query->filterWhere(['between', 'DATE(tgl)', $dateFrom, $dateTo]);
            }
        }
        return $dataProvider;
    }
}
