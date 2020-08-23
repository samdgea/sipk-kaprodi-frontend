<?php

namespace app\models;

use Yii;
use app\models\query\SapMhsListQuery;

/**
 * This is the model class for table "sap_mhs_list".
 *
 * @property int $id
 * @property int|null $major_id
 * @property string|null $periode_smt
 * @property int|null $total_mhs
 * @property string $created_at
 * @property string $updated_at
 */
class SapMahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_mhs_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['major_id', 'total_mhs'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['periode_smt'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'major_id' => 'Major ID',
            'periode_smt' => 'Periode Smt',
            'total_mhs' => 'Total Mhs',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SapMhsListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SapMhsListQuery(get_called_class());
    }
}
