<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SatuanBesar]].
 *
 * @see SatuanBesar
 */
class SatuanBesarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SatuanBesar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SatuanBesar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
