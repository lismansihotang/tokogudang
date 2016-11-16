<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VInvoice]].
 *
 * @see VInvoice
 */
class VInvoiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VInvoice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VInvoice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
