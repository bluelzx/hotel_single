<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_mg_rooms_at".
 *
 * @property string $id
 * @property string $app_id
 * @property string $checkin_id
 * @property string $room_no
 * @property string $name
 * @property string $real_price
 * @property string $price_plan
 * @property string $room_type
 * @property integer $checkin_time
 * @property integer $checkout_time
 * @property string $night_count
 * @property string $total_amount
 * @property string $check_check_status
 * @property integer $created_at
 * @property integer $updated_at
 */
class RoomsAt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_mg_rooms_at';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id','checkin_id', 'room_no', 'name', 'real_price', 'price_plan', 'room_type', 'checkin_time', 'checkout_time', 'night_count', 'total_amount', 'check_status'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['checkin_id'], 'string', 'max' => 50],
            [['room_no'], 'string', 'max' => 20],
            [['name', 'price_plan', 'room_type'], 'string', 'max' => 30],
            [['real_price', 'total_amount'], 'string', 'max' => 10],
            [['night_count'], 'string', 'max' => 5],
            [['check_status'], 'string', 'max' => 1],
            ['checkin_time', 'filter', 'filter' => function ($value) {
                return strtotime($value);
            }],
            ['checkout_time', 'filter', 'filter' => function ($value) {
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
            'checkin_id'=>'checkin_id',
            'room_no' => 'Room No',
            'name' => 'Real Name',
            'real_price' => 'Real Price',
            'price_plan' => 'Price Plan',
            'room_type' => 'Room Type',
            'checkin_time' => 'Checkin Time',
            'checkout_time' => 'Checkout Time',
            'night_count' => 'Night Count',
            'total_amount' => 'Total Amount',
            'check_status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
