<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "barang_mutasi_stock".
 *
 * @property integer $id
 * @property string  $tgl
 * @property integer $id_barang
 * @property integer $stock_awal
 * @property integer $stock
 * @property string  $harga
 * @property string  $keterangan
 */
class BarangMutasiStock extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barang_mutasi_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tgl', 'id_barang', 'stock_awal', 'stock'], 'required'],
            [['tgl'], 'safe'],
            [['id_barang', 'stock_awal', 'stock'], 'integer'],
            [['harga'], 'number'],
            [['keterangan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'tgl'        => 'Tanggal',
            'id_barang'  => 'Nama Barang',
            'stock_awal' => 'Stock Awal',
            'stock'      => 'Stock',
            'harga'      => 'Harga',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return BarangMutasiStockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarangMutasiStockQuery(get_called_class());
    }
}
