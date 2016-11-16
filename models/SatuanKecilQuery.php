<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SatuanKecil]].
 *
 * @see SatuanKecil
 */
class SatuanKecilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SatuanKecil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SatuanKecil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
