<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satuan_besar".
 *
 * @property integer $id
 * @property string $nm_satuan
 * @property integer $konversi_satuan
 */
class SatuanBesar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satuan_besar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['konversi_satuan'], 'integer'],
            [['nm_satuan'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_satuan' => 'Nama Satuan',
            'konversi_satuan' => 'Konversi Satuan',
        ];
    }

    /**
     * @inheritdoc
     * @return SatuanBesarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SatuanBesarQuery(get_called_class());
    }
}
