<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelanggan".
 *
 * @property integer $id
 * @property string $nm_pelanggan
 * @property string $alamat
 * @property string $no_telp
 * @property string $barcode
 * @property string $card_number
 * @property string $tgl_bergabung
 */
class Pelanggan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nm_pelanggan'], 'required'],
            [['alamat'], 'string'],
            [['tgl_bergabung'], 'safe'],
            [['nm_pelanggan', 'barcode', 'card_number'], 'string', 'max' => 35],
            [['no_telp'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_pelanggan' => 'Nama Pelanggan',
            'alamat' => 'Alamat',
            'no_telp' => 'No. Telp',
            'barcode' => 'Barcode',
            'card_number' => 'No. Kartu',
            'tgl_bergabung' => 'Tgl. bergabung',
        ];
    }

    /**
     * @inheritdoc
     * @return PelangganQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PelangganQuery(get_called_class());
    }
}
