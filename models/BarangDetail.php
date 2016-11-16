<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang_detail".
 *
 * @property integer $id
 * @property integer $id_barang
 * @property string $barcode
 */
class BarangDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barang_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_barang', 'barcode'], 'required'],
            [['id_barang'], 'integer'],
            [['barcode'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_barang' => 'Nama Barang',
            'barcode' => 'Barcode',
        ];
    }

    /**
     * @inheritdoc
     * @return BarangDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarangDetailQuery(get_called_class());
    }
}
