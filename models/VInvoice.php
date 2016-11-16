<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "v_invoice".
 *
 * @property integer $id
 * @property integer $penjualan_id
 * @property string  $tgl
 * @property string  $nominal
 * @property string  $desc
 * @property string  $status
 * @property string  $nm_pelanggan
 */
class VInvoice extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'penjualan_id'], 'integer'],
            [['tgl'], 'safe'],
            [['nominal'], 'number'],
            [['desc', 'status'], 'string'],
            [['nm_pelanggan'], 'required'],
            [['nm_pelanggan'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'penjualan_id' => 'No. Penjualan',
            'tgl'          => 'Tgl. Invoice',
            'nominal'      => 'Nominal',
            'desc'         => 'Keterangan',
            'status'       => 'Status',
            'nm_pelanggan' => 'Nama Pelanggan',
        ];
    }

    /**
     * @inheritdoc
     * @return VInvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VInvoiceQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getCustomerInvoice()
    {
        return $this->nm_pelanggan . ' / ' . $this->tgl . ' / ' . number_format($this->nominal);
    }
}
