<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CashRegister]].
 *
 * @see CashRegister
 */
class CashRegisterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CashRegister[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CashRegister|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
