<?php
namespace apps_admin\controllers;

use app\models\OrderRefund;
use app\models\WxAccounts;
use app\models\ZdhHotelOrderRefund;
use app\models\ZdhWxAccounts;
use app\models\ZdhWxPayRefundLog;
use common\components\wechat\pay\lib\WxPayApi;
use common\components\wechat\pay\lib\WxPayRefund;
use common\components\wechat\pay\lib\WxPayRefundQuery;
use common\components\wechat\pay\lib\WxPayResults;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use app\models\ZdhHotelOrder;
use common\controller\AdminController;
use yii\helpers\Url;
use yii\base\Object;

class OrderRefundController extends AdminController
{
    public function actionIndex()
    {

        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect("login/index");
        } else {
            define('DEBUG', 1);
            if (DEBUG) {
                if (0 == $_SESSION['acid']) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    $acid = \Yii::$app->user->identity->acid;
                }

                $refund_status = \Yii::$app->request->get('refund_status');
                //$oderstatus = (int) $_GET['order_status'];
                if (\Yii::$app->getRequest()->isPost) {
                    //搜索条件

                    $order_no = Yii::$app->request->post('order_no');//订单号
                    $order_time_from1 = Yii::$app->request->post('order_time_from');//操作时间从.......
                    $order_time_from = strtotime($order_time_from1);
                    $order_time_to1 = Yii::$app->request->post('order_time_to');//操作时间至.......
                    $order_time_to = strtotime($order_time_to1) + 86399;//加这个是为了让今天的也显示


                    /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引
                    $params = [
                        'acid' => $acid,
                        'refund_status' => $refund_status,
                        'order_no' => $order_no,
                        'order_time_from' => $order_time_from,
                        'order_time_to' => $order_time_to,
                        'offset' => $page,
                        'limit' => $pageSize
                    ];

                    $model = new ZdhHotelOrder();


                    $d = $model->getOrderList2($params);


                    foreach ($d['data'] as $k => $dd) {
                        $d['data'][$k]['created_time'] = date("Y-m-d H:i:s", $dd['created_time']);
                        $d['data'][$k]['order_time'] = date("Y-m-d H:i:s", $dd['order_time']);
                    }

                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render("index", array("refund_status" => $refund_status));
                }

            } else {

                $params = [
                    'acid' => Yii::$app->user->identity->acid,
                    'search' => '',
                    'refund_status' => '',
                    'offset' => '',
                    'limit' => ''
                ];

                /*       $model=new ZdhHotelOrder();


                      $d=$model->getOrderList2($params);
                      var_dump($d);die; */
                $params = [
                    'acid' => Yii::$app->user->identity->acid,
                    'search' => '',
                    'refund_status' => '',
                    'offset' => '',
                    'limit' => ''
                ];
                /*   $model = new ZdhHotelOrder();
                 $d = $model->getOrderList2($params);
                 echo "<pre>";
                 print_r($d);
                 exit;  */
                $Where = ['acid' => Yii::$app->user->identity->acid];
                $model = new ZdhHotelOrder();
                $d = $model->find()->select(['zo.order_id', 'zo.order_on', 'zo.goods_name', 'zo.real_name', 'zo.order_time', 'zo.phone', 'zo.totalc_price', 'zo.room_count', 'zr.amount', 'zr.created_time', 'zr.reason_content', 'zr.refund_status', 'zr.order_no'])
                    ->where($Where)->asArray()->all();
                echo "<pre>";
                print_r($d);
                echo "<pre>";
            }

        }
    }

    /*
     * 手动处理订单方法
     * */
    public function actionHandle()
    {
        // echo $_POST['handle']; echo $_POST['ordernumber'];die;
        $handle = $_POST['handle'];
        //echo $handle;die;
        $ordernumber = $_POST['ordernumber'];
        if ($handle == "未处理") {
            $handle = 0;
        } elseif ($handle == "处理中") {//accepted_time
            $handle = 1;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},accepted_time= {$time} WHERE order_no = {$ordernumber} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();
        } elseif ($handle == "已完成") {//complete_time
            $handle = 2;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},complete_time= {$time} WHERE order_no = {$ordernumber} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();


            $connect3 = \Yii::$app->db;
            $sql3 = "UPDATE zdh_hotel_order  SET order_status = 7 WHERE order_on = {$ordernumber} ";
            $command3 = $connect3->createCommand($sql3);
            $command3->execute();


        } elseif ($handle == "已关闭") {//closed_time
            $handle = 3;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},closed_time= {$time} WHERE order_no = {$ordernumber} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();


            $connect3 = \Yii::$app->db;
            $sql3 = "UPDATE zdh_hotel_order  SET order_status = 7 WHERE order_on = {$ordernumber} ";
            $command3 = $connect3->createCommand($sql3);
            $command3->execute();

        }

        $this->redirect(array('order-refund/index'));

    }

    //订单查询
    public function actionSearch()
    {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (0 == $_SESSION['acid']) {
                $acid = $_SESSION['s_acid'];
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $OrderNo = trim($_POST['order_no']);//$_POST['order_no'] 订单号，见index.php
            $From = $_POST['order_time_from'];//时间从...
            $To = $_POST['order_time_to'];//时间到...
            // echo $OrderNo;die;

            if (empty($OrderNo) && empty($From) && empty($To)) {

                $Where = 'zo.acid=' . $acid;//zo即是zdh_hotel_order,zr即是zdh_hotel_order_refund
                $connection = \Yii::$app->db;
                $sql = "SELECT * FROM zdh_hotel_order zo INNER JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no order by order_time DESC";
                $command = $connection->createCommand($sql);
                $Raw = $command->queryAll();
            }


            if (!empty($OrderNo)) {
                $Where = 'zo.acid=' . $acid . ' and zr.order_no=' . $OrderNo;//zo即是zdh_hotel_order,zr即是zdh_hotel_order_refund
                $connection = \Yii::$app->db;
                $sql = "SELECT * FROM zdh_hotel_order zo LEFT JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no where $Where";
                $command = $connection->createCommand($sql);
                $Raw = $command->queryAll();

            } else if (!empty($From) && !empty($To)) {
                $From = strtotime($From);
                $To = strtotime($To) + 3600 * 24 - 1;
                //echo $From;echo "<br/>";echo $To;exit();
                $Where = 'acid=' . $acid . ' and zr.created_time >= ' . $From . ' and zr.created_time <= ' . $To;
                $connection = \Yii::$app->db;
                // $sql =" SELECT * FROM zdh_hotel_order zo LEFT JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no where zo.order_time >=1481126400 and zo.order_time <=1481299200" ;
                $sql = "SELECT * FROM zdh_hotel_order zo INNER JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no where $Where";
                $command = $connection->createCommand($sql);
                $Raw = $command->queryAll();

            } elseif (!empty($OrderNo) && !empty($From) && !empty($To)) {
                $From = strtotime($From);
                $To = strtotime($To) + 3600 * 24 - 1;
                $Where = 'zo.acid=' . $acid . ' and zr.order_no=' . $OrderNo . ' and zr.created_time >= ' . $From . ' and zr.created_time <= ' . $To;
                $connection = \Yii::$app->db;
                // $sql =" SELECT * FROM zdh_hotel_order zo LEFT JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no where zo.order_time >=1481126400 and zo.order_time <=1481299200" ;
                $sql = "SELECT * FROM zdh_hotel_order zo INNER JOIN zdh_hotel_order_refund zr ON zo.order_on=zr.order_no where $Where";
                $command = $connection->createCommand($sql);
                $Raw = $command->queryAll();
            }
            return $this->render('search', ['rows' => $Raw, "OrderNo" => $OrderNo]);
        }
    }


    public function actionSearchhandle()
    {
        // echo $_POST['handle']; var_dump($_GET['order_no']) ;die;
        $handle = $_POST['handle'];
        if ($handle == "未处理") {
            $handle = 0;
        } elseif ($handle == "处理中") {//accepted_time
            $handle = 1;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},accepted_time= {$time} WHERE order_no = {$_REQUEST['order_no']} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();
        } elseif ($handle == "已完成") {//complete_time
            $handle = 2;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},complete_time= {$time} WHERE order_no = {$_REQUEST['order_no']} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();


        } elseif ($handle == "已关闭") {//closed_time
            $handle = 3;
            $time = time();
            $connect = \Yii::$app->db;
            $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},closed_time= {$time} WHERE order_no = {$_REQUEST['order_no']} ";
            $command2 = $connect->createCommand($sql2);
            $command2->execute();

        }

        $this->redirect(array('order-refund/index'));

    }

    /**
     * 订单退款处理
     *
     */
    public function actionRefund()
    {
        if (Yii::$app->request->isPost) {
            $order_refund = ZdhHotelOrderRefund::findOne(['order_no' => $this->post('order_on')]);
            $input = new WxPayRefund();
            $input->SetOut_trade_no($order_refund->order_no);  //out_trade_no
            $input->SetOut_refund_no($order_refund->refund_no); //refund_no

            $total_fee = round(floatval($order_refund->amount * 100), 0);
            $input->SetTotal_fee($total_fee); //total_fee
            $input->SetRefund_fee($total_fee); //refund_fee

            //商户号
            $wx_account = ZdhWxAccounts::findOne(['acid' => $order_refund->acid]);
            define('CONF_WX_APPID', trim($wx_account->app_id)); //应用id
            define('CONF_WX_APPSECRET', trim($wx_account->app_secret)); //应用秘钥
            define('CONF_WX_TOKEN', trim($wx_account->token)); //授权令牌
            define('CONF_WX_ENCODINGAESKEY', trim($wx_account->encodingaeskey)); //消息秘钥
            define('CONF_WX_PAY_MCHID', trim($wx_account->pay_mchid)); //商户id
            define('CONF_WX_PAY_KEY', trim($wx_account->pay_key)); //支付密匙

            $input->SetOp_user_id($wx_account->pay_mchid);  //p_user_id

            $postObj = WxPayApi::refund($input);


            if ($postObj['return_code'] == 'SUCCESS') {

                //退款日志记录
                $model = new ZdhWxPayRefundLog();
                $model->attributes = $postObj;
                $model->acid = $order_refund->acid;
                $model->refund_channel = '';
                $model->save(false);

                $handle = 2;
                $time = time();
                $connect = \Yii::$app->db;
                $sql2 = "UPDATE zdh_hotel_order_refund SET refund_status = {$handle},complete_time= {$time} WHERE order_no = {$this->post('order_on')} ";
                $command2 = $connect->createCommand($sql2);
                $command2->execute();


                $connect3 = \Yii::$app->db;
                $sql3 = "UPDATE zdh_hotel_order  SET order_status = 7 WHERE order_on = {$this->post('order_on')} ";
                $command3 = $connect3->createCommand($sql3);
                $command3->execute();

                return $this->success('退款处理成功！', Url::to(['order-refund/index'], true));
            } else {
                return $this->error('退款处理失败 (' . $postObj['return_msg'] . ')！', Url::to(['order-refund/index'], true));
            }
        }

    }

    /**
     * 微信退款到账查询
     *
     */
    public function actionQueryRefund()
    {
        if (Yii::$app->request->isPost) {

            //商户号
            $wx_account = ZdhWxAccounts::findOne(['acid' => $this->post('acid')]);
            define('CONF_WX_APPID', trim($wx_account->app_id)); //应用id
            define('CONF_WX_APPSECRET', trim($wx_account->app_secret)); //应用秘钥
            define('CONF_WX_TOKEN', trim($wx_account->token)); //授权令牌
            define('CONF_WX_ENCODINGAESKEY', trim($wx_account->encodingaeskey)); //消息秘钥
            define('CONF_WX_PAY_MCHID', trim($wx_account->pay_mchid)); //商户id
            define('CONF_WX_PAY_KEY', trim($wx_account->pay_key)); //支付密匙

            $input = new WxPayRefundQuery();
            $input->SetOut_trade_no($this->post('order_no'));
            $postObj = WxPayApi::refundQuery($input);

            $return_status = ['SUCCESS' => '退款成功', 'FAIL' => '退款失败', 'PROCESSING' => '退款处理中', 'CHANGE' => '转入代发'];

            return $this->success($return_status[$postObj['refund_status_0']]);

        }
    }
}