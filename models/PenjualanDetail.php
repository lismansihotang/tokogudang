<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan_detail".
 *
 * @property integer $id
 * @property integer $id_penjualan
 * @property integer $id_barang
 * @property integer $jml
 * @property string  $harga
 * @property string  $subtotal
 */
class PenjualanDetail extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penjualan_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'id_barang'], 'required'],
            [['id_penjualan', 'id_barang', 'jml'], 'integer'],
            [['harga', 'subtotal'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'id_penjualan' => 'No. Pembelian',
            'id_barang'    => 'Nama Barang',
            'jml'          => 'Jml',
            'harga'        => 'Harga',
            'subtotal'     => 'Subtotal',
        ];
    }

    /**
     * @inheritdoc
     * @return PenjualanDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenjualanDetailQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }
}
