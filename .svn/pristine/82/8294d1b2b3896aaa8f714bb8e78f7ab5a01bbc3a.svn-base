<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_mg_revenue_record".
 *
 * @property string $id
 * @property string $app_id
 * @property integer $stats_date
 * @property string $stats_data
 * @property string $type
 * @property integer $created_at
 */
class RevenueRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_mg_revenue_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id','stats_date', 'stats_data', 'type'], 'required'],
            [['created_at'], 'integer'],
            [['stats_data'], 'number'],
            [['type'], 'string', 'max' => 30],
            ['stats_date', 'filter', 'filter' => function ($value) {
                return strtotime($value);
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_id'=>'App ID',
            'stats_date' => 'Stats Date',
            'stats_data' => 'Stats Data',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }
}
