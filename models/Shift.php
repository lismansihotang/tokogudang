<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shift".
 *
 * @property integer $id
 * @property string $nm_shift
 * @property string $start_shift
 * @property string $finish_shift
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_shift', 'finish_shift'], 'safe'],
            [['nm_shift'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID Shift',
            'nm_shift' => 'Nama Shift',
            'start_shift' => 'Start Shift',
            'finish_shift' => 'Fnish Shift',
        ];
    }

    /**
     * @inheritdoc
     * @return ShiftQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShiftQuery(get_called_class());
    }
}
