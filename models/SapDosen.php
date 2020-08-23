<?php

namespace app\models;

use Yii;
use app\models\query\SapDosenQuery;

/**
 * This is the model class for table "sap_dsn_list".
 *
 * @property int $id
 * @property int|null $major_id
 * @property string|null $periode_smt
 * @property int|null $total_dsn
 * @property string $created_at
 * @property string $updated_at
 */
class SapDosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_dsn_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['major_id', 'total_dsn'], 'integer'],
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
            'total_dsn' => 'Total Dsn',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SapDosenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SapDosenQuery(get_called_class());
    }
}
