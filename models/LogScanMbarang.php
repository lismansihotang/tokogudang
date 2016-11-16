<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_scan_mbarang".
 *
 * @property integer $id
 * @property string $tgl
 * @property integer $id_barang
 * @property string $barcode
 * @property integer $user_id
 */
class LogScanMbarang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_scan_mbarang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'id_barang', 'user_id'], 'integer'],
            [['tgl'], 'safe'],
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
            'tgl' => 'Tgl.',
            'id_barang' => 'ID. Barang',
            'barcode' => 'Barcode',
            'user_id' => 'User ID.',
        ];
    }

    /**
     * @inheritdoc
     * @return LogScanMbarangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogScanMbarangQuery(get_called_class());
    }
}
