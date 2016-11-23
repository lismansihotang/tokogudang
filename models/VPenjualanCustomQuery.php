<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VPenjualanCustom]].
 *
 * @see VPenjualanCustom
 */
class VPenjualanCustomQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VPenjualanCustom[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VPenjualanCustom|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
