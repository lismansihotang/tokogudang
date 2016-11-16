<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satuan_kecil".
 *
 * @property integer $id
 * @property string $nm_satuan
 */
class SatuanKecil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satuan_kecil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nm_satuan'], 'required'],
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
        ];
    }

    /**
     * @inheritdoc
     * @return SatuanKecilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SatuanKecilQuery(get_called_class());
    }
}
