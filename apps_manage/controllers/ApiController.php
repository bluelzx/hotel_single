<?php
namespace apps_manage\controllers;

use app\models\MgAdmin;
use app\models\RevenueRecord;
use app\models\RoomsAt;
use app\models\RoomsLive;
use app\models\Shift;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ApiController extends \common\controller\ApiController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * api测试
     */
    public function actionTest()
    {
        $this->layout = false;
        return $this->render('test');
    }

    /**
     * 同步相关营收数据接口
     *
     * @return mixed
     */
    public function actionRevenueHistory()
    {
        if (yii::$app->request->isPost) {

            $model = new RevenueRecord();
            $model->attributes = $this->post1();
            $model->created_at = time();
            $result = $model->save();

            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 同步房间数据初始化
     */
    public function actionRoomInit()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            if (empty($post)) return $this->error('数据格式不正确！');
            if (empty($post['app_id']))
                return $this->error('请求参数缺失！');

            //清除之前数据
            RoomsLive::deleteAll(['app_id' => $post['app_id']]);

            foreach ($post['rooms_list'] as $room) {
                $model = new RoomsLive();
                $model->setAttributes($room);
                $model->app_id = $post['app_id'];
                $model->created_at = time();
                $result = $model->save();
            }

            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 同步房间状态变化
     */
    public function actionRoomStatus()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            if (empty($post)) return $this->error('数据格式不正确！');
            if (empty($post['app_id']))
                return $this->error('请求参数缺失！');

            $model = RoomsLive::findOne(['app_id' => $post['app_id'], 'room_no' => $post['room_no']]);
            $model->status = $post['status'];
            $model->room_price = $post['room_price'];
            $model->start_date = $post['start_date'];
            $model->end_date = $post['end_date'];

            $result=$model->save();
            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 同步入住和离店信息
     *
     * @return mixed
     */
    public function actionCheckInAndOut()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            if (empty($post)) return $this->error('数据格式不正确！');
            if (empty($post['check_status']) || empty($post['checkin_id']) || empty($post['app_id']))
                return $this->error('请求参数缺失！');

            $model = RoomsAt::find()->where(['app_id' => $post['app_id'], 'checkin_id' => $post['checkin_id']])->one();
            $room = RoomsLive::findOne(['app_id' => $post['app_id'], 'room_no' => $post['room_no']]);
            if ($post['check_status'] == '1') {//入店操作
                if (!$model) {
                    $model = new RoomsAt();
                    $model->attributes = $post;
                    $model->created_at = time();

                    //更新房态为入住
                    $room->status = '2';
                    $room->room_price = $post['real_price'];
                    $room->start_date = $post['checkin_time'];
                    $room->end_date = $post['checkout_time'];
                } else {
                    return $this->error('入住信息重复提交！');
                }
            } else if ($post['check_status'] == '0') {//离店操作
                if (!$model) {
                    $model->status = '0';
                    $model->updated_at = time();

                    //更新房态为离店
                    $room->status = '1';
                } else {
                    return $this->error('要处理的离店信息不存在！');
                }
            } else {
                if (!$model) {
                    $model->attributes = $post;

                    //更新房态为入住
                    $room->status = '2';
                    $room->room_price = $post['real_price'];
                    $room->start_date = $post['checkin_time'];
                    $room->end_date = $post['checkout_time'];
                } else {
                    return $this->error('要延长入住的记录信息不存在！');
                }
            }
            $result = $model->save();
            $room->save();
            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 同步交班信息
     *
     * @return mixed
     */
    public function actionHotelShift()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            /*if (empty($post['class_id']))
                return $this->error('请求参数缺失！');*/

            $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;

            $model = Shift::find()->where(['app_id' => $post['app_id'], 'class_people' => $post['class_people'], 'class_no' => $post['class_no']])->andWhere(['between', 'class_date', $beginToday, $endToday])->one();
            if (empty($model)) {
                $model = new Shift();
                $model->attributes = $this->post1();
                $model->created_at = time();
                $result = $model->save();
                $msg = $result ? $this->success() : $this->error($model->getErrors());
            } else {
                $msg = $this->error('此交班数据已经提交过了！');
            }
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 同步管理员
     */
    public function actionUser()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            /*if (empty($post['app_id']))
                return $this->error('请求参数缺失！');*/

            $model = MgAdmin::findOne(['app_id' => $post['class_id'], 'username' => $post['username']]);
            if (empty($model)) {
                $model = new MgAdmin();
                $model->attributes = $post;
                $model->created_at = time();
            } else {
                $model->attributes = $post;
                $model->updated_at = time();
            }
            $result = $model->save();

            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * 删除所有营业数据(手动调用)
     */
    public function actionDelAll()
    {
        if (yii::$app->request->isPost) {
            $post = $this->post1();
            if (empty($post['app_id']))
                return $this->error('请求参数缺失！');

            RevenueRecord::deleteAll(['app_id' => $post['app_id']]);
            RoomsAt::deleteAll(['app_id' => $post['app_id']]);
            RoomsLive::deleteAll(['app_id' => $post['app_id']]);
            Shift::deleteAll(['app_id' => $post['app_id']]);

            $msg = $this->success();
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }

    /**
     * @return array
     */
    //测试数据
    private function livedata()
    {
        $arr = [
            'ruzhu_rate' => '52%',
            'total_amount' => 1686.0,
            'empty_room' => [
                'room_count' => 10,
                'room_list' => [
                    ['room_no' => '88100', 'room_type' => '情侣房'],
                    ['room_no' => '88106', 'room_type' => '标准单人间'],
                    ['room_no' => '88211', 'room_type' => '标准单人间'],
                    ['room_no' => '88206', 'room_type' => '特价房'],
                    ['room_no' => '88310', 'room_type' => '特价房'],
                    ['room_no' => '88101', 'room_type' => '豪华单人房'],
                    ['room_no' => '88305', 'room_type' => '豪华单人房'],
                    ['room_no' => '88309', 'room_type' => '豪华单人房'],
                    ['room_no' => '88208', 'room_type' => '豪华单人房(电)'],
                    ['room_no' => '88301', 'room_type' => '超豪华(电)'],
                ]
            ],
            'dirty_room' => [
                'room_count' => 1,
                'room_list' => [
                    ['room_no' => '88105', 'room_type' => '豪华单人房']
                ]
            ],
            'living_room' => [
                'room_count' => 13,
                'room_list' => [
                    ['room_no' => '88300', 'room_type' => '情侣房'],
                    ['room_no' => '88205', 'room_type' => '标准单人间'],
                    ['room_no' => '88212', 'room_type' => '标准单人间'],
                    ['room_no' => '88109', 'room_type' => '标准单人(电)'],
                    ['room_no' => '88102', 'room_type' => '标准双人房'],
                    ['room_no' => '88202', 'room_type' => '标准双人房'],
                    ['room_no' => '88302', 'room_type' => '标准双人房'],
                    ['room_no' => '88201', 'room_type' => '标准双人房(电)'],
                    ['room_no' => '88308', 'room_type' => '标双棋牌室'],
                    ['room_no' => '88209', 'room_type' => '豪华单人间'],
                    ['room_no' => '88208', 'room_type' => '豪华单人间(电)'],
                    ['room_no' => '88306', 'room_type' => '豪华单人间(电)'],
                    ['room_no' => '88108', 'room_type' => '豪双棋牌室']
                ]
            ],
            'maintain_room' => [
                'room_count' => 1,
                'room_list' => [
                    ['room_no' => '88210', 'room_type' => '豪华单人间']
                ]
            ],
            'arrival_room' => [
                'room_count' => 2,
                'room_list' => [
                    ['room_no' => '88400', 'room_type' => '情侣房'],
                    ['room_no' => '88405', 'room_type' => '标准单人间'],
                ]
            ],
            'personal_use_room' => [
                'room_count' => 1,
                'room_list' => [
                    ['room_no' => '88407', 'room_type' => '标准单人间']
                ]
            ],
            'room_type_list' => ['协议房价', '情侣房', '标准单人房', '标准单人(电)', '标准双人房', '标准双人房(电)', '标双棋牌室', '特价房', '豪华单人间', '豪华单人房(电)', '豪双棋牌室', '超豪华(电)'],
        ];

        return $arr;
    }

    public function actionTest1()
    {
        if (yii::$app->request->isPost) {

            $model = new RevenueRecord();
            $model->attributes = $this->post1();
            $model->created_at = time();
            $result = $model->save();

            $msg = $result ? $this->success() : $this->error($model->getErrors());
            return $msg;
        } else {
            return $this->error('数据提交方式不正确！');
        }
    }
}
