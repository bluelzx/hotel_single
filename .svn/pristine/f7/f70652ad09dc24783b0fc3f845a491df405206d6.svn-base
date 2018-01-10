<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_hotel_room_type_price".
 *
 * @property integer $id
 * @property integer $acid
 * @property integer $room_type_id
 * @property string $price_plan
 * @property string $oprice
 * @property string $cprice
 * @property string $hprice
 * @property integer $status
 */
class RoomTypePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_hotel_room_type_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid', 'room_type_id', 'status'], 'integer'],
            [['room_type_id', 'price_plan', 'oprice', 'cprice', 'hprice'], 'required'],
            [['oprice', 'cprice', 'hprice'], 'number'],
            [['price_plan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acid' => 'Acid',
            'room_type_id' => 'Room Type ID',
            'price_plan' => 'Price Plan',
            'oprice' => 'Oprice',
            'cprice' => 'Cprice',
            'hprice' => 'Hprice',
            'status' => 'Status',
        ];
    }
}
