<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_jual_detail".
 *
 * @property integer $id_ljd
 * @property integer $id_penjualan
 * @property string $tgl_penjualan
 * @property integer $id_barang
 * @property string $harga_beli
 * @property string $insert_date
 */
class LogJualDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_jual_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'id_barang'], 'integer'],
            [['tgl_penjualan', 'insert_date'], 'safe'],
            [['harga_beli'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ljd' => 'ID',
            'id_penjualan' => 'ID. Penjualan',
            'tgl_penjualan' => 'Tgl. Penjualan',
            'id_barang' => 'ID. Barang',
            'harga_beli' => 'Harga Beli',
            'insert_date' => 'Insert Date',
        ];
    }

    /**
     * @inheritdoc
     * @return LogJualDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogJualDetailQuery(get_called_class());
    }
}
