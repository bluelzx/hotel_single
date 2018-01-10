<?php
namespace apps_admin\controllers;

use app\models\ZdhHotelRoomTypePrice;
use app\models\ZdhHotelRoomType;
use app\models\ZdhHotel;
use Yii;
use common\controller\AdminController;
use yii\helpers\Url;

/**
 * Site controller
 */
class RoomPriceController extends AdminController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public $enableCsrfValidation = false;

    public function actionIndex() {
        set_time_limit(0);
        define('DEBUG',1);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(DEBUG) {
                if(0 == $_SESSION['acid']) {
                    if(isset($_SESSION['s_acid'])) {
                        $acid = $_SESSION['s_acid'];
                    } else {
                        return $this->redirect(['account/acclist']);//公众号列表
                    }
                } else {
                    $acid = Yii::$app->user->identity->acid;
                }
                if (Yii::$app->request->isPost) {
                    //搜索条件
                    $Search = Yii::$app->request->post('sSearch');
                    $RoomTypeModel = new ZdhHotelRoomTypePrice();

                    /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $maxRows = $RoomTypeModel->find()->count();           //总记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引

                    $RoomTypeModel = new ZdhHotelRoomTypePrice();
                    $params = [
                        'acid' => $acid,
                        'search' => $Search,
                        'offset' => $page,
                        'limit' => $pageSize
                    ];
                    $d = $RoomTypeModel->getRoomPriceList($params);
                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render('index');
                }
            } else {
                $model = new ZdhHotelRoomTypePrice();
                $d = $model->find()->select(['room_type_id'])->where(['id'=>14])->asArray()->one();
                echo "<pre>";
                print_r($d);
                exit;
                $RoomTypeModel = new ZdhHotelRoomTypePrice();
                $d = $RoomTypeModel->find()->select(['id','room_type_id','price_plan','oprice','cprice','hprice','status'])->where(['acid'=>Yii::$app->user->identity->acid])->asArray()->all(); //获取数据
                //$RoomTypeModel = new ZdhHotelRoomTypePrice();
                //$d = $RoomTypeModel->getRoomPriceList(3);
                var_dump($d);
            }
        }
    }

    //显示隐藏
    public function actionShow() {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(0 == $_SESSION['acid']) {
                if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    return $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $id = $_GET['id'];
            $c = $_GET['c'];

            if(1 == $c) {
                $model = new ZdhHotelRoomTypePrice();
                $RoomType = $model->find()->select(['room_type_id'])->where(['id'=>$id])->asArray()->one();
                $params = [
                    'room_type_id' => $RoomType['room_type_id'],
                    'acid' => $acid
                ];
                $model->setStatus($params);
            }

            $model = ZdhHotelRoomTypePrice::findOne(['id' => $id,'acid' => $acid]);
            $model->status=$c;
            $res = $model->update();
            $msg = $res ? $this->success('修改成功！', Url::to(['room-price/index'], true)) : $this->error('修改失败，请稍后再试！');
            return $msg;
        }

    }

    public function actionUpdate() {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define('DEBUG',1);
            if(DEBUG) {
                if(0 == $_SESSION['acid']) {
                    if(isset($_SESSION['s_acid'])) {
                        $acid = $_SESSION['s_acid'];
                    } else {
                        return $this->redirect(['account/acclist']);//公众号列表
                    }
                } else {
                    $acid = Yii::$app->user->identity->acid;
                }
                $id = $_GET['id'];
                if (Yii::$app->request->isPost) {
                    $PricePlan = trim($_POST['price_plan']);
                    $Oprice =  $_POST['oprice'];
                    $Cprice = $_POST['cprice'];
                    $Status = $_POST['status'];
                    $RoomType = $_POST['room_type'];
                    $CheckoutTimeset = $_POST['checkout_timeset'];
                    $model = new ZdhHotelRoomTypePrice;
                    if(1 == $Status) {
                        $params = [
                            'room_type_id' => $RoomType,
                            'acid' => $acid
                        ];
                        $model->setStatus($params);
                    }

                    $model = ZdhHotelRoomTypePrice::findOne(['acid'=>$acid,'id' => $id]);
                    $model->price_plan = $PricePlan;
                    $model->checkout_timeset = $CheckoutTimeset;
                    $model->oprice = $Oprice;
                    $model->cprice = $Cprice;
                    $model->status = $Status;
                    $model->room_type_id = $RoomType;
                    $model->update();
                    return $this->render('update',['id'=>$id]);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $params = [
                        'acid' => $acid,
                        'id' => $id
                    ];
                    $RoomTypeModel = new ZdhHotelRoomTypePrice();
                    $Result = $RoomTypeModel->getRoomPriceDetail($params);
                    $model2 = new ZdhHotelRoomType();
                    $Result['room_type'] = $model2->find()->select(['name','id'])->where(['acid' => $acid,'is_del' => 0])->asArray()->all();
                    return $this->ajaxOutput($Result);
                } else {
                    return $this->render('update',['id'=>$id]);
                }
            } else {
                $RoomTypeModel = new ZdhHotelRoomTypePrice();
                $Result = $RoomTypeModel->getRoomPriceDetail(Yii::$app->user->identity->acid);
                echo "<pre>";
                print_r($Result);
                echo "<pre>";
                exit;
            }
        }
    }

    //删除记录
    public function actionDel() {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            return $this->render('index');
        } else {
            if(0 == $_SESSION['acid']) {
                if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    return $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $id = $_GET['id'];
            $model = ZdhHotelRoomTypePrice::findOne(['id' => $id,'acid' => $acid]);
            $del = $model->delete();
            $msg = $del ? $this->success('删除成功！', Url::to(['room-price/index'], true)) : $this->error('删除失败，请稍后再试！');
            return $msg;
        }
    }

    //添加数据
    public function actionAdd() {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(0 == $_SESSION['acid']) {
                if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    return $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            if (Yii::$app->request->isPost) {
                $PricePlan = trim($_POST['price_plan']); //房价类型
                $Oprice = $_POST['oprice']; //原价
                $Cprice = $_POST['cprice']; //优惠价
                $Status = $_POST['status'];
                $RoomType = $_POST['room_type'];
                $CheckoutTimeset = $_POST['checkout_timeset'];
                $model = new ZdhHotelRoomTypePrice;
                if(1 == $Status) {
                    $params = [
                        'room_type_id' => $RoomType,
                        'acid' => $acid
                    ];
                    $model->setStatus($params);
                }
                $model->acid = $acid;
                $model->price_plan = $PricePlan;
                $model->oprice = $Oprice;
                $model->cprice = $Cprice;
                $model->status = $Status;
                $model->checkout_timeset = $CheckoutTimeset;
                $model->room_type_id = $RoomType;
                $model->save();
                $this->redirect(['index']);
            } else if(Yii::$app->getRequest()->getIsAjax()) {
                $model = new ZdhHotel();
                $dk = $model->find()->select(['title'])->where(['acid' => $acid])->asArray()->one();

                $model2 = new ZdhHotelRoomType();
                $dk['room_type'] = $model2->find()->select(['name','id'])->where(['acid' => $acid,'is_del' => 0])->asArray()->all();
                return $this->ajaxOutput($dk);
            } else {
                return $this->render('add');
            }
        }
    }

    public function actionCheckplan() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $plan = $_POST['price_plan'];
            $model = new ZdhHotelRoomTypePrice();
            $param['plan'] = $plan;
            $d = $model->check($param);
            return $this->ajaxOutput($d);
        }
    }
}