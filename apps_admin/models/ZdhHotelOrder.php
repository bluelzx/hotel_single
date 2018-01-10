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

class ZdhHotelOrder extends ActiveRecord
{

    public static function tableName()
    {
        return 'zdh_hotel_order';
    }

    //获取订单列表
    public function getOrderList($_params = [])
    {
        if (!empty($_params['search']) && !empty($_params['order_time_from']) && !empty($_params['order_time_to'])) {
            $Where = 'acid = ' . $_params['acid'] . ' and order_on = ' . $_params['search'] . ' and order_time >=' . $_params['order_time_from'] . ' and order_time <=' . $_params['order_time_to'];
        } else if (!empty($_params['order_time_from']) && !empty($_params['order_time_to'])) {
            $Where = 'acid = ' . $_params['acid'] . ' and order_time >=' . $_params['order_time_from'] . ' and order_time <=' . $_params['order_time_to'];
        } else if (!empty($_params['search'])) {
            $Where = 'acid = ' . $_params['acid'] . ' and order_on = ' . $_params['search'];
        } else {
            $Where = 'acid = ' . $_params['acid'];
        }

        if (88 != $_params['order_type']) {
            $Where .= ' and order_status = ' . $_params['order_type'];
        }

        $Query = (new Query())->select('order_id,order_on,goods_name,real_name,phone,totalc_price,order_status,order_time,actual_arrival_time')
            ->from('zdh_hotel_order')
            ->where($Where)->orderBy("order_time DESC")->offset($_params['offset'])->limit($_params['limit']);

        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();
        return $Raws;
    }


    //获取订单详情
    public function getOrderDetail($_params = [])
    {
        $Raw = (new Query())->select('zo.order_on,zo.order_status,zu.nickname,zh.title,zr.room_type_name,zo.room_count,zo.totalc_price,
        zo.real_name,zo.phone,zo.checkin_time,zo.checkout_time,zo.order_time,zo.arrival_time,zo.goods_name,zo.pay_type,zo.actual_arrival_time,zp.checkout_timeset')->from(['zo' => 'zdh_hotel_order'])
            ->leftJoin(['zu' => 'zdh_wx_user'], 'zo.open_id = zu.open_id')
            ->leftJoin(['zh' => 'zdh_hotel'], 'zh.acid = zo.acid')
            ->leftJoin(['zr' => 'zdh_hotel_order_room'], 'zo.order_on = zr.order_on')
            ->leftJoin(['zp' => 'zdh_hotel_room_type_price'], 'zo.goods_id = zp.room_type_id')
            ->where('zo.order_id = ' . $_params['orders_id'] . ' and zo.acid = ' . $_params['acid'])
            ->one();
        return $Raw;
    }


    //获取订单列表
    public function getOrderList2($_params = [])
    {
        if (!empty($_params['search'])) {
            $Where = 'zo.acid = ' . $_params['acid'] . ' and goods_name like "%' . $_params['search'] . '%"';
        } else {
            $Where = 'zo.acid = ' . $_params['acid'];
        }

        if (isset($_params['refund_status'])) {
            $Where .= ' and refund_status = ' . $_params['refund_status'];
        }


        if (!empty($_params['order_no']) && !empty($_params['order_time_from']) && !empty($_params['order_time_to'])) {
            $Where = 'zo.acid = ' . $_params['acid'] . ' and zr.order_no ="' . $_params['order_no'] . '" and zr.created_time >= ' . $_params['order_time_from'] . ' and zr.created_time <= ' . $_params['order_time_to'];
        } elseif (!empty($_params['order_no'])) {
            $Where = 'zo.acid = ' . $_params['acid'] . ' and zr.order_no = "' . $_params['order_no'] . '"';
        } elseif (!empty($_params['order_time_from']) && !empty($_params['order_time_to'])) {
            $Where = 'zo.acid = ' . $_params['acid'] . ' and zr.created_time >= ' . $_params['order_time_from'] . ' and zr.created_time <= ' . $_params['order_time_to'];
        }


        $Query = (new Query())->select('zo.acid,zo.order_id,zo.order_time,zo.order_on,zo.goods_name,zo.real_name,zo.order_time,zo.phone,zo.totalc_price,zo.room_count,zr.amount,zr.created_time,zr.reason_content,zr.refund_status,zr.order_no')
            ->from(['zo' => 'zdh_hotel_order'])
            ->innerJoin(['zr' => 'zdh_hotel_order_refund'], 'zo.order_on=zr.order_no')
            ->where($Where)->orderBy("zo.order_time DESC")->offset($_params['offset'])->limit($_params['limit']);

        /*  SELECT COUNT(*) FROM `zdh_hotel_order` `zo` INNER JOIN `zdh_hotel_order_refund` `zr` ON zo.order_on=zr.order_no
         WHERE acid = 3 and refund_status = ORDER BY `zo`.`order_time` DESC */


        $C_Query = clone $Query;
        $Raws['count'] = $C_Query->count();
        $Raws['data'] = $Query->all();
        return $Raws;
    }


}






