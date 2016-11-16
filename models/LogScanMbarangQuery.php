<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LogScanMbarang]].
 *
 * @see LogScanMbarang
 */
class LogScanMbarangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LogScanMbarang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LogScanMbarang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
