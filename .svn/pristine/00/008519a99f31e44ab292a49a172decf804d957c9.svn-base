<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zdh_hotel_room_type".
 *
 * @property integer $id
 * @property integer $acid
 * @property string $name
 * @property string $thumb
 * @property string $attrs
 * @property integer $room_num
 * @property string $sales
 * @property string $other
 * @property integer $display_order
 * @property integer $status
 */
class RoomType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zdh_hotel_room_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acid', 'room_num', 'display_order', 'status'], 'integer'],
            [['attrs', 'sales', 'other'], 'required'],
            [['sales', 'other'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['thumb'], 'string', 'max' => 255],
            [['attrs'], 'string', 'max' => 1500],
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
            'name' => 'Name',
            'thumb' => 'Thumb',
            'attrs' => 'Attrs',
            'room_num' => 'Room Num',
            'sales' => 'Sales',
            'other' => 'Other',
            'display_order' => 'Display Order',
            'status' => 'Status',
        ];
    }

    /**
     * 获取所有房间类型
     */
    public function getRoomTypes()
    {
        return $this->hasOne(RoomTypePrice::className(), ['room_type_id' => 'id']);;
    }
}
