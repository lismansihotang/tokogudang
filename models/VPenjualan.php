<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "v_penjualan".
 *
 * @property integer $id
 * @property string  $tgl
 * @property integer $id_pelanggan
 * @property string  $nm_pelanggan
 * @property string  $subtotal
 * @property string  $disc
 * @property string  $pajak
 * @property string  $total
 * @property string  $pembayaran
 * @property string  $tipe_bayar
 */
class VPenjualan extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pelanggan'], 'integer'],
            [['tgl', 'nm_pelanggan'], 'required'],
            [['tgl'], 'safe'],
            [['subtotal', 'disc', 'pajak', 'total', 'pembayaran'], 'number'],
            [['tipe_bayar'], 'string'],
            [['nm_pelanggan'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'tgl'          => 'Tgl. Pembelian',
            'id_pelanggan' => 'Pelanggan',
            'nm_pelanggan' => 'Nama Pelanggan',
            'subtotal'     => 'Subtotal',
            'disc'         => 'Discount',
            'pajak'        => 'Pajak',
            'total'        => 'Total',
            'pembayaran'   => 'Pembayaran',
            'tipe_bayar'   => 'Tipe Bayar',
        ];
    }

    /**
     * @inheritdoc
     * @return VPenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VPenjualanQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getCustomerNominal()
    {
        return $this->nm_pelanggan . ' / ' . $this->tgl . ' / ' . number_format($this->total);
    }
}
