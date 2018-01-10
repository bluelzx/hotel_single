<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/18
 * Time: 16:03
 */
namespace app\models;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\db\ActiveRecord;

class ZdhHotelRoomTypeAttr extends ActiveRecord {
    public static function tableName() {
        return 'zdh_hotel_room_type_attr';
    }

    public function saveAttr($_params = []) {
        $Conn = Yii::$app->db;
        $Result = $Conn->createCommand()->insert('zdh_hotel_room_type_attr',[
            'room_type_id'=> $_params['room_type_id'],
            'attr_id'=> $_params['attr_id'],
            'attr_value'=> $_params['attr_value']
        ])->execute();
        return $Result;
    }

    public function updateAttr($_params = []) {
        $Conn = Yii::$app->db;
        if(isset($_params['id']) && !empty($_params['id'])) {
            $Res = $Conn->createCommand()->update('zdh_hotel_room_type_attr', [
                'attr_value'=>$_params['attr_value']],
                [
                    "id" => $_params['id'],
                    "room_type_id" => $_params['room_type_id'],
                    "attr_id" => $_params['attr_id']
                ])->execute();
        } else {
            $Res = $Conn->createCommand()->update('zdh_hotel_room_type_attr', [
                'attr_value'=>$_params['attr_value']],
                [
                    "room_type_id" => $_params['room_type_id'],
                    "attr_id" => $_params['attr_id']
                ])->execute();
        }

        return $Res;
    }

    public function deleteAttr($_params = []) {
        $Conn = Yii::$app->db;
        $Ret = $Conn->createCommand()->delete('zdh_hotel_room_type_attr', [
            'id' => $_params['id']
        ])->execute();
        return $Ret;
    }
}