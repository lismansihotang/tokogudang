<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PelangganQuota]].
 *
 * @see PelangganQuota
 */
class PelangganQuotaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PelangganQuota[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PelangganQuota|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
