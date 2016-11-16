<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BarangMutasiStock]].
 *
 * @see BarangMutasiStock
 */
class BarangMutasiStockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BarangMutasiStock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BarangMutasiStock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
