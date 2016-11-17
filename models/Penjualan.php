<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan".
 *
 * @property integer $id
 * @property string  $tgl
 * @property integer $id_pelanggan
 * @property string  $subtotal
 * @property string  $disc
 * @property string  $pajak
 * @property string  $total
 * @property string  $pembayaran
 * @property string  $tipe_bayar
 * @property string  $card_number
 */
class Penjualan extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tgl'], 'required'],
            [['tgl'], 'safe'],
            [['id_pelanggan'], 'integer'],
            [['subtotal', 'disc', 'pajak', 'total', 'pembayaran'], 'string'],
            [['tipe_bayar', 'card_number'], 'string'],
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
            'subtotal'     => 'Subtotal',
            'disc'         => 'Discount',
            'pajak'        => 'Pajak',
            'total'        => 'Total',
            'pembayaran'   => 'Pembayaran',
            'tipe_bayar'   => 'Tipe Bayar',
            'card_number'  => 'Card Number',
        ];
    }

    /**
     * @inheritdoc
     * @return PenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenjualanQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggan()
    {
        return $this->hasOne(Pelanggan::className(), ['id' => 'id_pelanggan']);
    }
}
