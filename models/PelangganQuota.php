<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelanggan_quota".
 *
 * @property integer $id
 * @property integer $pelanggan_id
 * @property string $nominal
 * @property integer $user_insert
 * @property string $insert_date
 * @property integer $user_update
 * @property string $update_date
 */
class PelangganQuota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelanggan_quota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pelanggan_id'], 'required'],
            [['pelanggan_id', 'user_insert', 'user_update'], 'integer'],
            [['insert_date', 'update_date', 'nominal'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pelanggan_id' => 'ID Pelanggan',
            'nominal' => 'Nominal',
            'user_insert' => 'User ID Insert',
            'insert_date' => 'Tgl. Insert',
            'user_update' => 'User ID Update',
            'update_date' => 'Tgl. Update',
        ];
    }

    /**
     * @inheritdoc
     * @return PelangganQuotaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PelangganQuotaQuery(get_called_class());
    }
}
