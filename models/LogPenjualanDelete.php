<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_penjualan_delete".
 *
 * @property integer $id
 * @property integer $id_penjualan
 * @property integer $id_barang
 * @property integer $jml
 * @property string $harga
 * @property string $subtotal
 * @property string $tgl
 * @property integer $user_id
 */
class LogPenjualanDelete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_penjualan_delete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'id_barang', 'jml', 'user_id'], 'integer'],
            [['harga', 'subtotal'], 'number'],
            [['tgl'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_penjualan' => 'ID Penjualan',
            'id_barang' => 'ID Barang',
            'jml' => 'Jml',
            'harga' => 'Harga',
            'subtotal' => 'Subtotal',
            'tgl' => 'Tgl.',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @inheritdoc
     * @return LogPenjualanDeleteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogPenjualanDeleteQuery(get_called_class());
    }
}
