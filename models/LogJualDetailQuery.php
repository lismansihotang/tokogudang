<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LogJualDetail]].
 *
 * @see LogJualDetail
 */
class LogJualDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LogJualDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LogJualDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
