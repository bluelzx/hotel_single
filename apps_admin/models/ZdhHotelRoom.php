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

class ZdhHotelRoom extends ActiveRecord {

    public static function tableName() {
        return 'zdh_hotel_room';
    }

    /*    public function rules() {
            return [
                [
                    [['is_toshop','is_notice','is_tpl_notice'],'integer'],
                    [['tpl_user','tpl_booking','tpl_unsubscribe','tpl_waiting','tpl_book_success','tpl_unsubscribe_success','tpl_unsubscribe_handle'],'string']
                ]
            ];
        }*/

    public function getRoomList($_params = []) {
        if(!empty($_params['search']) && !empty($_params['room_no'])) {
            $Where = 'zr.acid = ' . $_params['acid'] .' and zt.acid = ' . $_params['acid'] . ' and zt.name like "%'. $_params['search'].'%" and zr.room_no = '. $_params['room_no'].'';
        } else if(!empty($_params['room_no'])) {
            $Where = 'zr.acid = ' . $_params['acid'] .' and zt.acid = ' . $_params['acid'] . ' and zr.room_no = '. $_params['room_no'].'';
        } else if(!empty($_params['search'])) {
            $Where = 'zr.acid = ' . $_params['acid'] .' and zt.acid = ' . $_params['acid'] . ' and zt.name like "%'. $_params['search'].'%"';
        } else {
            $Where = 'zr.acid = ' . $_params['acid'] . ' and zt.acid = ' . $_params['acid'];
        }
        $Query = (new Query())->select('zr.id,zt.name,zr.room_no,zr.is_special,zr.status')->from([
            'zr' => 'zdh_hotel_room'
        ])
            ->leftJoin(['zt' => 'zdh_hotel_room_type'],"zr.room_type_id = zt.id")
            ->where($Where)->offset($_params['offset'])->limit($_params['limit']);

        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();

        return $Raws;
    }

    public function search($_params = []) {
        if(!empty($_params['room_type']) && !empty($_params['room_no'])) {
            $Where = 'zr.acid = ' . $_params['acid'] . ' and zt.acid = ' . $_params['acid'] . ' and zt.name = "' . $_params['room_type'] . '" and zr.room_no = ' . $_params['room_no'];
        } else if(!empty($_params['room_type'])) {
            $Where = 'zr.acid = ' . $_params['acid'] . ' and zt.acid = ' . $_params['acid'] . ' and zt.name = "' . $_params['room_type'].'"';
        } else if(!empty($_params['room_no'])) {
            $Where = 'zr.acid = ' . $_params['acid'] . ' and zt.acid = ' . $_params['acid'] . ' and zr.room_no = ' . $_params['room_no'];
        }
        $Raw = (new Query())->select("zr.id,zt.name,zr.room_no,zr.is_special,zr.status")
            ->from(['zt' => 'zdh_hotel_room_type'])
            ->leftJoin(['zr' => 'zdh_hotel_room'],"zt.id = zr.room_type_id")
            ->where($Where)->all();
        return $Raw;
    }

    public function del($_params = []) {
        $Conn = Yii::$app->db;
        $Ret = $Conn->createCommand()->delete('zdh_hotel_room', [
            'id' => $_params['id'],
            'acid' => $_params['acid'],
        ])->execute();

        $Ret = $Conn->createCommand()->delete('zdh_hotel_room_attr', [
            'room_id' => $_params['id'],
        ])->execute();
        return $Ret;
    }

    public function check($_params = []) {
        if(isset($_params['room_no'])) {
            $where = "room_no=".$_params['room_no'];
        }
        if(isset($_params['room_code'])) {
            $where = "room_code=".$_params['room_code'];
        }
        $Rows = (new Query())->select('id')->from("zdh_hotel_room")->where($where)->one();
        if(empty($Rows)) {
            return false;
        } else {
            return $Rows;
        }
    }
}






