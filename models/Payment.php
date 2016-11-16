<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property string $tgl
 * @property string $nominal
 * @property string $desc
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id'], 'integer'],
            [['tgl'], 'safe'],
            [['nominal'], 'number'],
            [['desc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'No. Invoice',
            'tgl' => 'Tgl. Payment',
            'nominal' => 'Nominal',
            'desc' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentQuery(get_called_class());
    }
}
