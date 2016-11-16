<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cash_register".
 *
 * @property integer $id
 * @property integer $shift_id
 * @property string $tgl
 * @property string $nominal
 * @property string $start_cash
 * @property string $finish_cash
 */
class CashRegister extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cash_register';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shift_id'], 'integer'],
            [['tgl', 'start_cash', 'finish_cash'], 'safe'],
            [['nominal'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cash ID',
            'shift_id' => 'ID Shift',
            'tgl' => 'Tanggal',
            'nominal' => 'Nominal',
            'start_cash' => 'Start',
            'finish_cash' => 'Finish',
        ];
    }

    /**
     * @inheritdoc
     * @return CashRegisterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CashRegisterQuery(get_called_class());
    }
}
