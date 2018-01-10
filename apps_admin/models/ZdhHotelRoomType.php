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

class ZdhHotelRoomType extends ActiveRecord {

    public static function tableName() {
        return 'zdh_hotel_room_type';
    }

    /*    public function rules() {
            return [
                [
                    [['is_toshop','is_notice','is_tpl_notice'],'integer'],
                    [['tpl_user','tpl_booking','tpl_unsubscribe','tpl_waiting','tpl_book_success','tpl_unsubscribe_success','tpl_unsubscribe_handle'],'string']
                ]
            ];
        }*/

    public function getRoomTypeList($_params = []) {
        if(!empty($_params['search'])) {
            $Where = 'is_del = 0 and acid = ' . $_params['acid'] .' and name like "%'. $_params['search'].'%"';
        } else {
            $Where = 'is_del = 0 and acid = ' . $_params['acid'];
        }
        $Query = (new Query())->select('id,name,thumb,attrs,room_num,sales,other,display_order,status,is_del')->from('zdh_hotel_room_type')
        ->where($Where)->orderBy("display_order ASC")->offset($_params['offset'])->limit($_params['limit']);

        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();

        return $Raws;
    }

    public function del($_params = []) {
        $Conn = Yii::$app->db;
/*        $Ret1 = $Conn->createCommand()->delete('zdh_hotel_room_type', [
            'id' => $_params['id'],
            'acid' => $_params['acid'],
        ])->execute();*/

        $Ret1 = $Conn->createCommand()->update('zdh_hotel_room_type', [
            'is_del'=>1],
            ["id" => $_params['id']])->execute();

        $Ret2 = $Conn->createCommand()->delete('zdh_hotel_room_type_attr', [
            'room_type_id' => $_params['id'],
        ])->execute();
        return ($Ret1 || $Ret2);
    }

    public function check($_params = []) {
        $Rows = (new Query())->select('id')->from("zdh_hotel_room_type")->where("name='".$_params['name']."' and acid = ".$_params['acid'] . " and is_del=0")->one();
        if(empty($Rows)) {
            return false;
        } else {
            return $Rows;
        }
    }
}






