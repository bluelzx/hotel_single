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

class ZdhHotelSetting extends ActiveRecord {

    public static function tableName() {
        return 'zdh_hotel_setting';
    }

/*    public function rules() {
        return [
            [
                [['is_toshop','is_notice','is_tpl_notice'],'integer'],
                [['tpl_user','tpl_booking','tpl_unsubscribe','tpl_waiting','tpl_book_success','tpl_unsubscribe_success','tpl_unsubscribe_handle'],'string']
            ]
        ];
    }*/

}






