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

class ZdhHotelRoomTypePrice extends ActiveRecord {

    public static function tableName() {
        return 'zdh_hotel_room_type_price';
    }

    public function getRoomPriceList($_params) {
        if(!empty($_params['search'])) {
            $Where = 'zp.acid = ' . $_params['acid'] .' and zp.price_plan like "%'. $_params['search'].'%"';
        } else {
            $Where = 'zp.acid = ' . $_params['acid'];
        }
        $Query = (new Query())->select('zp.id,zt.name,zp.room_type_id,zp.price_plan,zp.oprice,zp.cprice,zp.hprice,zp.status')->from(['zp' => 'zdh_hotel_room_type_price'])
            ->leftJoin(['zt' => 'zdh_hotel_room_type'],'zp.room_type_id = zt.id')
            ->where($Where)->offset($_params['offset'])->limit($_params['limit']);
        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();
        return $Raws;
    }

    //获取房价详情
    public function getRoomPriceDetail($_params) {
        $Raw = (new Query())->select('zh.title,zp.price_plan,zp.oprice,zp.cprice,zp.status,zp.room_type_id,zp.checkout_timeset')->from(['zp' => 'zdh_hotel_room_type_price'])
            ->leftJoin(['zh' => 'zdh_hotel'],'zp.acid = zh.acid')
            ->where('zp.acid = ' . $_params['acid'] .' and zp.id = ' . $_params['id'])
            ->limit(1)
            ->one();
        return $Raw;
    }

    public function check($_params = []) {
        $Rows = (new Query())->select('id')->from("zdh_hotel_room_type_price")->where("price_plan='".$_params['plan']."'")->one();
        if(empty($Rows)) {
            return false;
        } else {
            return $Rows;
        }
    }

    public function setStatus($_params = []) {
        $conn = Yii::$app->db;
        $res = $conn->createCommand()->update("zdh_hotel_room_type_price",[
            'status' => 0
        ],[
            'room_type_id' => $_params['room_type_id'],
            'acid' => $_params['acid']
        ])->execute();
        return $res;
    }
}






