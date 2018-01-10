<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_mg_rooms_live".
 *
 * @property string $id
 * @property string $app_id
 * @property string $room_no
 * @property string $room_price
 * @property string $room_type
 * @property string $room_type_code
 * @property string $room_price_code
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $status
 * @property integer $created_at
 */
class RoomsLive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_mg_rooms_live';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'room_no', 'room_price', 'room_type', 'room_type_code', 'room_price_code', 'status'], 'required'],
            [['room_no'], 'string'],
            [['room_price'], 'number'],
            [['status', 'created_at'], 'integer'],
            [['app_id', 'room_type'], 'string', 'max' => 30],
            [['room_type_code'], 'string', 'max' => 255],
            [['room_price_code'], 'string', 'max' => 10],
            ['start_date', 'filter', 'filter' => function ($value) {
                if (!empty($value))
                    return strtotime($value);
                else
                    return 0;
            }],
            ['end_date', 'filter', 'filter' => function ($value) {
                if (!empty($value))
                    return strtotime($value);
                else
                    return 0;
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
            'app_id' => 'App ID',
            'room_no' => 'Room No',
            'room_price' => 'Room Price',
            'room_type' => 'Room Type',
            'room_type_code' => 'Room Type Code',
            'room_price_code' => 'Room Price Code',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
        ];
    }
}
