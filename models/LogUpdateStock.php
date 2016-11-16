<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_update_stock".
 *
 * @property integer $id
 * @property string $tgl
 * @property integer $id_barang
 * @property integer $stock_awal
 * @property integer $stock_update
 * @property integer $user_id
 */
class LogUpdateStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_update_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tgl'], 'safe'],
            [['id_barang', 'stock_awal', 'stock_update', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl.',
            'id_barang' => 'ID Barang',
            'stock_awal' => 'Stock Awal',
            'stock_update' => 'Stock Update',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @inheritdoc
     * @return LogUpdateStockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogUpdateStockQuery(get_called_class());
    }
}
