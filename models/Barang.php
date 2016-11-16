<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property integer $id
 * @property string  $nm_barang
 * @property string  $ket_barang
 * @property string  $harga_beli
 * @property string  $margin_jual
 * @property string  $harga_jual
 * @property integer $id_satuan_kecil
 * @property integer $id_satuan_besar
 * @property integer $id_kategori
 * @property integer $id_lokasi
 * @property integer $stock
 * @property integer $min_stock
 */
class Barang extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nm_barang', 'id_satuan_kecil', 'id_kategori'], 'required'],
            [['ket_barang'], 'string'],
            [['harga_beli', 'margin_jual', 'harga_jual'], 'number'],
            [['id_satuan_kecil', 'id_satuan_besar', 'id_kategori', 'id_lokasi', 'stock', 'min_stock'], 'integer'],
            [['nm_barang'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'nm_barang'       => 'Nama Barang',
            'ket_barang'      => 'Deskripsi Barang',
            'harga_beli'      => 'Harga Beli',
            'margin_jual'     => 'Margin Jual',
            'harga_jual'      => 'Harga Jual',
            'id_satuan_kecil' => 'Satuan Barang',
            'id_satuan_besar' => 'Satuan Pembelian',
            'id_kategori'     => 'Kategori Barang',
            'id_lokasi'       => 'Lokasi',
            'stock'           => 'Stock',
            'min_stock'       => 'Min. Stock',
        ];
    }

    /**
     * @inheritdoc
     * @return BarangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarangQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuanKecil()
    {
        return $this->hasOne(SatuanKecil::className(), ['id' => 'id_satuan_kecil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuanBesar()
    {
        return $this->hasOne(SatuanBesar::className(), ['id' => 'id_satuan_besar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori(){
        return $this->hasOne(Kategori::className(),['id'=>'id_kategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasi(){
        return $this->hasOne(Lokasi::className(),['id'=>'id_lokasi']);
    }
}
