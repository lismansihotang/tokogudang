<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lokasi]].
 *
 * @see Lokasi
 */
class LokasiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Lokasi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Lokasi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
