<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_penjualan_custom".
 *
 * @property integer $id
 * @property string $tgl
 * @property integer $id_pelanggan
 * @property string $disc
 * @property string $pajak
 * @property string $total
 * @property string $pembayaran
 * @property string $tipe_bayar
 * @property integer $user_id
 * @property string $insert_date
 * @property string $update_date
 * @property string $card_number
 * @property integer $id_barang
 * @property integer $jml
 * @property string $harga
 * @property string $subtotal
 * @property string $barcode
 * @property string $nm_barang
 * @property string $harga_beli
 * @property string $margin_jual
 * @property string $harga_jual
 */
class VPenjualanCustom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_penjualan_custom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pelanggan', 'user_id', 'id_barang', 'jml'], 'integer'],
            [['tgl', 'id_barang', 'nm_barang'], 'required'],
            [['tgl', 'insert_date', 'update_date'], 'safe'],
            [['disc', 'pajak', 'total', 'pembayaran', 'harga', 'subtotal', 'harga_beli', 'margin_jual', 'harga_jual'], 'number'],
            [['tipe_bayar'], 'string'],
            [['card_number', 'barcode', 'nm_barang'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl. Pembelian',
            'id_pelanggan' => 'Pelanggan',
            'disc' => 'Discount',
            'pajak' => 'Pajak',
            'total' => 'Total',
            'pembayaran' => 'Pembayaran',
            'tipe_bayar' => 'Tipe Bayar',
            'user_id' => 'User ID',
            'insert_date' => 'Tgl. Insert',
            'update_date' => 'Tgl. Update',
            'card_number' => 'No. Kartu',
            'id_barang' => 'Nama Barang',
            'jml' => 'Jml',
            'harga' => 'Harga',
            'subtotal' => 'Subtotal',
            'barcode' => 'Barcode',
            'nm_barang' => 'Nama Barang',
            'harga_beli' => 'Harga Beli',
            'margin_jual' => 'Margin Jual',
            'harga_jual' => 'Harga Jual',
        ];
    }

    /**
     * @inheritdoc
     * @return VPenjualanCustomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VPenjualanCustomQuery(get_called_class());
    }
}
