<?php
namespace apps_admin\controllers;

use app\models\ZdhHotelSetting;
use Yii;
use yii\web\Controller;
use app\models\ZdhSysAdmin;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
/**
 * Site controller
 */
class BasicController extends Controller
{
    public $enableCsrfValidation = false;
    private $setting;
    //初始化
    public function init() {

    }

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
            $_SESSION['username'] = Yii::$app->user->identity->username;
            if(0 == Yii::$app->user->identity->acid) { // $_SESSION['acid'] 超级管理员
                $_SESSION['wx_account'] = "超级管理员";
                if(!isset($_SESSION['acid'])) {  //从 remeber me 进入
                    $_SESSION['acid'] = Yii::$app->user->identity->acid;
                }
                if(isset($_GET['acid'])/* || (0 == Yii::$app->user->identity->acid)*/) {
                    $_SESSION['back'] = $_GET['acid'];
                    isset($_GET['acid']) && $_SESSION['s_acid'] = (int)$_GET['acid'];
                    $acid = $_SESSION['s_acid'];
                } if(isset($_SESSION['back'])) {
                    $acid = $_SESSION['back'];
                } else {
                    $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                if(!isset($_SESSION['s_acid'])) {
                    $_SESSION['s_acid'] = Yii::$app->user->identity->acid;
                    $_SESSION['acid'] = Yii::$app->user->identity->acid;
                }
                $acid = Yii::$app->user->identity->acid;
                $model_account = new ZdhSysAdmin();
                $acid_account['acid'] = $_SESSION['s_acid'];
                $account = $model_account->getWechatAccount($acid_account);
                $_SESSION['wx_account'] = $account['name'];
            }

            if (Yii::$app->request->isPost) {
                if(isset($_POST) && !empty($_POST)) {
                    $ToShop = (int)$_POST['toshop']; //是否开启到店付款
                    $Notice = (int)$_POST['notice'];//是否信息提醒
                    $UserOpenid = trim($_POST['user_openid']); //通知用户OPENID
                    $TplNotice = (int)$_POST['tpl_notice']; //模板消息通知
                    $Booking = trim($_POST['booking']); //管理员新订单通知提醒模板ID
                    $UnSubscribe = trim($_POST['unsubscribe']); //管理员酒店退房/退款通知提醒模板ID
                    $Waiting = trim($_POST['waiting']); //等待付款通知提醒模板ID
                    $BookSuccess = trim($_POST['book_success']); //酒店预订成功通知提醒模板ID
                    $UnSubscribeSuccess = trim($_POST['unsubscribe_success']); //酒店退订成功通知提醒模板ID
                    $UnSubscribeHandle = trim($_POST['unsubscribe_handle']); //订单退款处理通知提醒模板ID

                    $Setting = new ZdhHotelSetting();
                    $d = $Setting->find()->select(['acid'])->where(['acid'=>$acid])->asArray()->one();
                    $OpData = [
                        'toshop' => $ToShop,
                        'notice' => $Notice,
                        'user_poenid' => $UserOpenid,
                        'tpl_notice' => $TplNotice,
                        'booking' => $Booking,
                        'unsubscribe' => $UnSubscribe,
                        'waiting' => $Waiting,
                        'book_success' => $BookSuccess,
                        'unsubscribe_success' => $UnSubscribeSuccess,
                        'unsubscribe_handle' => $UnSubscribeHandle
                    ];
                    if(empty($d)) {  //新建基本设置
                        $Setting->acid = $acid;
                        $this->Opration($Setting,$OpData);
                        $Setting->insert();
                    } else { //更新基本设置
                        $UpdateSetObj = ZdhHotelSetting::find()->where(['acid'=>$acid])->one();
                        $this->Opration($UpdateSetObj,$OpData);
                        $UpdateSetObj->update();
                    }

                }

                $Setting = new ZdhHotelSetting();
                //初始化页面
                $d = $Setting->find()->select(['is_toshop','is_notice','tpl_user','is_tpl_notice','tpl_booking','tpl_unsubscribe','tpl_waiting','tpl_book_success','tpl_unsubscribe_success','tpl_unsubscribe_handle'])
                    ->where(['acid'=>$acid])->asArray()->one();

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $d;
            } else {
                //$model = new ZdhHotelSetting();
                //判断该管理员是否已经保存过设置
                return $this->render('index');
            }
        }
    }

    private function Opration($obj,$arr = []) {
        $obj->is_toshop = $arr['toshop'];
        $obj->is_notice = $arr['notice'];
        $obj->tpl_user = $arr['user_poenid'];
        $obj->is_tpl_notice = $arr['tpl_notice'];
        $obj->tpl_booking = $arr['booking'];
        $obj->tpl_unsubscribe = $arr['unsubscribe'];
        $obj->tpl_waiting = $arr['waiting'];
        $obj->tpl_book_success = $arr['book_success'];
        $obj->tpl_unsubscribe_success = $arr['unsubscribe_success'];
        $obj->tpl_unsubscribe_handle = $arr['unsubscribe_handle'];
    }

}
