<?php
namespace apps_wechat\controllers;

use Yii;
use app\models\Order;
use app\models\RoomType;
use apps_wechat\components\Common;
use common\controller\WechatController;


/**
 * 订单处理 controller
 */
class OrderController extends WechatController
{


    /**
     * 预订
     * @return string
     */
    public function actionBooking()
    {
        $room_type_id = Yii::$app->request->get('room_type_id');
        $model = RoomType::find()->joinWith('roomTypes')->where(['zdh_hotel_room_type.id' => $room_type_id])->asArray()->one();

        $data = [
            'room_type_id' => $room_type_id,
            'model' => $model
        ];
        return $this->render('booking', $data);
    }

    /**
     * 创建订单
     */
    public function actionCreateOrder()
    {
        if (Yii::$app->request->isPost) {
            $model = new Order();
            $roomType = RoomType::find()->innerJoinWith(['roomTypes'])->where(['zdh_hotel_room_type.id' => $this->post('room_type_id')])->one();
            $order_on = Common::generate_order_no();
            $data = [
                'order_on' => $order_on,
                'goods_name' => $roomType->name,
                'uid' => '1',
                'real_name' => $this->post('real_name'),
                'phone' => $this->post('phone'),
                'id_card' => $this->post('id_card'),
                'arrival_time' => $this->post('arrival_time'),
                'room_count' => $this->post('room_count'),
                'room_days' => Common::diffBetweenTwoDays(Yii::$app->session['check_out_time'], Yii::$app->session['check_in_time']),
                'checkin_time' => Yii::$app->session['check_in_time'],
                'checkout_time' => Yii::$app->session['check_out_time'],
                'totalc_price' => floatval($roomType->roomTypes->cprice) * floatval($this->post('room_count')),
                'order_status' => '0',
                'order_time' => time()
            ];
            $model->setAttributes($data);

            if ($model->save()) {
                return $this->redirect(['order/pay', 'order_on' => $order_on]);
            }
        }
    }

    /**
     * 支付页面
     */
    public function actionPay()
    {
        $model = Order::findOne(['order_on' => $this->get('order_on')]);
        $data = [
            'model' => $model
        ];
        return $this->render('pay', $data);
    }

}
