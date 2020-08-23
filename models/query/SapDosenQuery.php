<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[SapDosen]].
 *
 * @see SapDosen
 */
class SapDosenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SapDosen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SapDosen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
