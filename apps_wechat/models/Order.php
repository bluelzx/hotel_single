<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_hotel_order".
 *
 * @property integer $order_id
 * @property integer $acid
 * @property string $order_on
 * @property string $goods_name
 * @property string $uid
 * @property string $real_name
 * @property string $phone
 * @property string $id_card
 * @property integer $room_count
 * @property integer $room_days
 * @property integer $checkin_time
 * @property integer $checkout_time
 * @property string $arrival_time
 * @property string $totalc_price
 * @property integer $pay_type
 * @property integer $order_status
 * @property integer $order_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_hotel_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_count', 'room_days', 'order_status', 'order_time'], 'integer'],
            [['order_on', 'goods_name', 'uid', 'real_name', 'phone', 'room_count', 'room_days', 'checkin_time', 'checkout_time', 'totalc_price'], 'required'],
            [['totalc_price'], 'number'],
            [['order_on', 'real_name', 'phone'], 'string', 'max' => 50],
            [['goods_name', 'uid'], 'string', 'max' => 255],
            [['id_card'], 'string', 'max' => 18],
            [['arrival_time'], 'string', 'max' => 10],
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
            'order_id' => 'Order ID',
            'acid' => 'Acid',
            'order_on' => 'Order On',
            'goods_name' => 'Goods Name',
            'uid' => 'Uid',
            'real_name' => 'Real Name',
            'phone' => 'Phone',
            'id_card' => 'Id Card',
            'room_count' => 'Room Count',
            'room_days' => 'Room Days',
            'checkin_time' => 'Checkin Time',
            'checkout_time' => 'Checkout Time',
            'arrival_time' => 'Arrival Time',
            'totalc_price' => 'Totalc Price',
            'pay_type' => 'Pay Type',
            'order_status' => 'Order Status',
            'order_time' => 'Order Time',
        ];
    }
}
