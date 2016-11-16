<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LogUpdateStock]].
 *
 * @see LogUpdateStock
 */
class LogUpdateStockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LogUpdateStock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LogUpdateStock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
