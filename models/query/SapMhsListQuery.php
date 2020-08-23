<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[SapMahasiswa]].
 *
 * @see SapMahasiswa
 */
class SapMhsListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SapMahasiswa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SapMahasiswa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
