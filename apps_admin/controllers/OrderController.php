<?php
namespace apps_admin\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\ZdhHotelOrder;
use common\controller\AdminController;
use yii\helpers\Url;
/**
 * Site controller
 */
class OrderController extends AdminController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
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
                $OrderType = (int) $_GET['order_type'];
                if(Yii::$app->getRequest()->getIsAjax()) {
                    //搜索条件
                    $Search = Yii::$app->request->post('sSearch');
                    $OrderNo = Yii::$app->request->post('order_no');
                    $OrderTimeFrom = Yii::$app->request->post('order_time_from');
                    $OrderTimeTo = Yii::$app->request->post('order_time_to');
                    /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引
                    $params = [
                        'acid' => $acid,
                        'search' => $OrderNo,
                        'order_time_from' => strtotime($OrderTimeFrom),
                        'order_time_to' => strtotime($OrderTimeTo),
                        'order_type' => $OrderType,
                        'offset' => $page,
                        'limit' => $pageSize
                    ];

                    $model = new ZdhHotelOrder();
                    $d = $model->getOrderList($params);
                    foreach($d['data'] as $k => $dd) {
                        $d['data'][$k]['order_time'] = date("Y-m-d H:i:s",$dd['order_time']);
                        if($dd['actual_arrival_time'] > 0) {
                            $d['data'][$k]['disabled'] = 1;
                            $d['data'][$k]['actual_arrival_time'] = date("Y-m-d H:i:s",$dd['actual_arrival_time']);
                        } else {
                            $d['data'][$k]['actual_arrival_time'] = "";
                            $d['data'][$k]['disabled'] = 0;
                        }
                    }
                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render('index',['order_type' => $OrderType]);
                }
            } else {
                $model = new ZdhHotelOrder();
                $d = $model->find()->select(['checkin_time'])->where(['order_id' => 46])->asArray()->one();
                echo "<pre>";
                print_r($d);
                exit;
/*                $params = [
                    'acid' => Yii::$app->user->identity->acid,
                    'search' => '',
                    'order_type' => '',
                    'offset' => '',
                    'limit' => ''
                ];
                $model = new ZdhHotelOrder();
                $d = $model->getOrderList($params);
                echo "<pre>";
                print_r($d);
                exit;*/
                $Where = ['acid'=>Yii::$app->user->identity->acid];
                $model = new ZdhHotelOrder();
                $d = $model->find()->select(['order_id','order_on','goods_name','real_name','phone','totalc_price','order_status','order_time'])
                    ->where($Where)->asArray()->all();
                echo "<pre>";
                print_r($d);
                echo "<pre>";
            }
        }
    }

    //确定入住
    public function actionConfirm() {
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

            $model = new ZdhHotelOrder();
            $d = $model->find()->select(['checkin_time'])->where(['order_id' => $id])->asArray()->one();
            if($d['checkin_time'] > time()) {
                $msg = 0 ? $this->success('修改成功！', Url::to(['room-price/index'], true)) : $this->error('未到入住时间，不能确定入住！');
                return $msg;
            } else {
                $model = ZdhHotelOrder::findOne(['order_id' => $id,'acid' => $acid]);
                $model->order_status = 3;
                $model->actual_arrival_time=time();
                $res = $model->update();
                $msg = $res ? $this->success('修改成功！', Url::to(['room-price/index'], true)) : $this->error('修改失败，请稍后再试！');
                return $msg;
            }
        }

    }


    //订单详情
    public function actionOrderdetail() {
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
                $OrderID = (int) $_GET['order_id'];
                if(Yii::$app->getRequest()->getIsAjax()) {
                    //$OrderID = (int) $_GET['order_id'];
                    $model = new ZdhHotelOrder();
                    $params = [
                        'acid' => $acid,
                        'orders_id' => $OrderID
                    ];
                    $d = $model->getOrderDetail($params);
                    $d['checkin_time'] = date("Y-m-d",$d['checkin_time']);
                    $d['actual_arrival_time'] = empty($d['actual_arrival_time']) ? "" : date("Y-m-d H:i:s",$d['actual_arrival_time']);
                    $d['checkout_time'] = date("Y-m-d",$d['checkout_time']);
                    $d['order_time'] = date("Y-m-d H:i:s",$d['order_time']);
                    return $this->ajaxOutput($d);
                } else {
                    return $this->render('orderdetail',['order_id' => $OrderID]);
                }
            } else {
                //$id = $_GET['id'];
                //echo $id."<br>";
                $model = new ZdhHotelOrder();
                $params = [
                    'acid' => Yii::$app->user->identity->acid,
                    'orders_id' => 192
                ];
                $d = $model->getOrderDetail($params);
                echo "<pre>";
                print_r($d);
                echo "<pre>";
            }
        }
    }

    //订单查询
    public function actionSearch() {
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
            $OrderNo = trim($_POST['order_no']);
            $From = $_POST['order_time_from'];
            $To = $_POST['order_time_to'];
            if(!empty($OrderNo)) {
                $Where = ['acid'=>$acid,'order_on' => $OrderNo];
                $d = (new Query())->select('order_id,order_on,goods_name,real_name,phone,totalc_price,order_status,order_time')->from('zdh_hotel_order')
                    ->where($Where)->one();
                $Raw[] = $d;
            } else if(!empty($From) && !empty($To)) {
                $From = strtotime($From);
                $To = strtotime($To);
                $Where = 'acid='.$acid . ' and order_time >= ' . $From . ' and order_time <= ' . $To;
                $Raw = (new Query())->select('order_id,order_on,goods_name,real_name,phone,totalc_price,order_status,order_time')->from('zdh_hotel_order')
                    ->where($Where)->all();
            }
            return $this->render('search',['rows' => $Raw]);
        }
    }
}
