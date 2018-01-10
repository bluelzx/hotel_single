<?php
namespace apps_admin\controllers;

use Yii;
use yii\db\Query;
use common\controller\AdminController;
use yii\helpers\Url;
use app\models\ZdhSysAdmin;
use app\models\ZdhWxAccounts;
/**
 * Site controller
 */
class AccountController extends AdminController
{
    public $enableCsrfValidation = false;
    //账户管理
    public function actionManage () {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (Yii::$app->request->isPost) {
                /* 初始化分页查询条件 */
                //搜索条件
                $Search = Yii::$app->request->post('sSearch');
                $model = new ZdhSysAdmin;
                $pageSize = $this->post('iDisplayLength');    //每页记录数
                $maxRows = $model->find()->count();           //总记录数
                $page = $this->post('iDisplayStart');     //当前起始索引
                $params = ['search' => $Search];
                $d = $model->getAccount($params);

                $list['iTotalRecords'] = $d['count'];   //总记录数
                $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                $list['aaData'] = $d['data'];      //表中数据
                return $this->ajaxOutput($list);
            } else {
                return $this->render('manage');
            }
        }
    }

    //普通管理员
    public function actionCommonManage() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define("DEBUG",0);
            if(!DEBUG) {
                if (Yii::$app->request->isPost) {
                    /* 初始化分页查询条件 */
                    //搜索条件
                    $Search = Yii::$app->request->post('sSearch');
                    $acid = Yii::$app->request->post('acid');
                    $model = new ZdhSysAdmin;
                    //$pageSize = $this->post('iDisplayLength');    //每页记录数
                    //$maxRows = $model->find()->count();           //总记录数
                    //$page = $this->post('iDisplayStart');     //当前起始索引
                    $params = [
                        'acid' => $acid,
                        'username' => $Search
                    ];
                    $d = $model->getAccount($params);

                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render('common-manage',['acid'=>$_SESSION['s_acid']]);
                }
            } else {

                $model = ZdhSysAdmin::findOne(['acid'=>3,'id'=>32]);
                echo "<pre>";
                print_r($model->username);
                exit;

                $params = [
                    'acid' => $_SESSION['s_acid']
                ];
                $model = new ZdhSysAdmin;
                $d = $model->getAccount($params);
                echo "<pre>";
                print_r($d);
            }
        }
    }

    //检测用户名
    public function actionCheckName() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $model = new ZdhSysAdmin;
            $UserName = Yii::$app->request->post('username');
            $d = $model->find()->select(['id'])->where(['username' => $UserName])->asArray()->one();
            if(!$d) {
                $d = 0;
            }
            return $this->ajaxOutput($d);
        }
    }

    //检测密码是否一致
    public function actionCheckPwd() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $PassWord = Yii::$app->request->post('pwd');
            $ConfirmPwd = Yii::$app->request->post('confirm_pwd');
            if($PassWord == $ConfirmPwd) {
                $d = 1;
            } else {
                $d = 0;
            }
            return $this->ajaxOutput($d);
        }
    }

    //普通管理员添加账号
    public function actionCommonAdd() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define("DEBUG",0);
            if(!DEBUG) {
                if(Yii::$app->getRequest()->getIsAjax()) {
                    $model = new ZdhSysAdmin;
                    $params = [
                        'acid' => $_SESSION['s_acid']
                    ];

                    $d = $model->getWechatAccount($params);
                    return $this->ajaxOutput($d);
                } else if (Yii::$app->request->isPost) {
                    $UserName = trim($_POST['accountname']);
                    $PassWord = trim($_POST['pwd']);
                    //$ConfirmPwd = trim($_POST['confirm_pwd']);

                    $model = new ZdhSysAdmin;

                    $model->acid = $_SESSION['s_acid'];
                    $model->username = $UserName;
                    $model->created_at = time();
                    $model->updated_at = time();
                    $model->password_hash = Yii::$app->security->generatePasswordHash($PassWord);
                    $model->save();
                    $this->redirect(['common-manage']);
                } else {
                    return $this->render('common-add');
                }
            } else {
                $model = new ZdhSysAdmin;
                $d = $model->find()->select(['id'])->where(['username' => 'admi'])->asArray()->one();
                if(!$d) {
                    $d = 0;
                }
                echo "<pre>";
                print_r($d);
            }
        }
    }

    //禁用账户
    public function actionDisable() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $Acid = (int) $_GET['acid'];
            $Status = (int) $_GET['sta'];
            $model = ZdhSysAdmin::findOne(['acid' => $Acid]);
            if(1 == $Status)
                $model->status = 2;
            if(2 == $Status)
                $model->status = 1;
            $model->update();
            $this->redirect(['manage']);
        }
    }

    //禁用账户
    public function actionCommonDisable() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $Acid = (int) $_GET['id'];
            $Status = (int) $_GET['sta'];
            $model = ZdhSysAdmin::findOne(['id' => $Acid]);
            if(1 == $Status)
                $model->status = 2;
            if(2 == $Status)
                $model->status = 1;
            $model->update();
            $this->redirect(['common-manage']);
        }
    }

    //添加账户
    public function actionAdd() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (Yii::$app->request->isPost) {
                $UserName = trim($_POST['username']);
                $PassWord = trim($_POST['pwd']);
                $ConfirmPwd = trim($_POST['confirm_pwd']);
                $Wechat = (int) $_POST['wechat'];

                $model = new ZdhSysAdmin;
                if($Wechat) {
                    $Raw = $model->find()->select(['id'])->where(['acid' => $Wechat])->asArray()->one();
                    if(!empty($Raw['id'])) {
                        echo "<script>";
                        echo "alert('该公众号已经存在');";
                        echo "history.back();";
                        echo "</script>";
                        exit;
                    }
                }

                if($PassWord != $ConfirmPwd) {
                    echo "<script>";
                    echo "alert('两次密码不正确');";
                    echo "history.back();";
                    echo "</script>";
                    exit;
                } else {
                    $model->acid = $Wechat;
                    $model->username = $UserName;
                    $model->password_hash = Yii::$app->security->generatePasswordHash($PassWord);
                    $model->save();
                    $this->redirect(['manage']);
                }
            } else if(Yii::$app->getRequest()->getIsAjax()) {
                $model = new ZdhSysAdmin;
                $d = $model->getWechatList();
                return $this->ajaxOutput($d);
            } else {
                return $this->render('add');
            }
        }
    }

    public function actionDelete() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $id = (int) $_GET['id'];
            $model = ZdhSysAdmin::findOne(['id'=>$id]);
            $del = $model->delete();
            $msg = $del ? $this->success('删除成功！', Url::to(['account/manage'], true)) : $this->error('删除失败，请稍后再试！');
            return $msg;
        }
    }

    public function actionCommdel() {
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
            $id = (int) $_GET['id'];
            $model = ZdhSysAdmin::findOne(['acid'=>$acid,'id'=>$id]); //Yii::$app->user->identity->username
            if($model->username == Yii::$app->user->identity->username) {
                $del = 0;
                $msg = $del ? $this->success('删除成功！', Url::to(['account/manage'], true)) : $this->error('删除失败，该用户正处于登陆状态不能删除！');
                return $msg;
            } else {
                $del = $model->delete();
                $msg = $del ? $this->success('删除成功！', Url::to(['account/manage'], true)) : $this->error('删除失败，请稍后再试！');
                return $msg;
            }
        }
    }

    //公众号列表
    public function actionAcclist() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define('DEBUG',1);
            if(DEBUG) {
                if(isset($_SESSION['s_acid'])) {
                    $_SESSION['s_acid'] = '';
                    unset($_SESSION['s_acid']);
                }
                $_SESSION['wx_account'] = "超级管理员";
                $h = Yii::$app->params['hotelsingle'];
                $model = new ZdhWxAccounts();
                $Rows = $model->getAccountList();
                return $this->render('acclist',['d' => $Rows,'h' => $h]);
            } else {
                $model = new ZdhWxAccounts();
                $Rows = $model->getAccountList();
                echo "<pre>";
                print_r($Rows);
            }
        }
    }

    //公众号管理/更新
    public function actionAccmanage() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define('DEBUG',1);
            if(DEBUG) {
                $Acid = (int) Yii::$app->request->get('id');
                if(Yii::$app->request->isPost) {
                    $error_type_qrcode_pic = 0;
                    $error_type_avatar = 0;
                    $Name = Yii::$app->request->post('gongz_name');
                    $Signature = Yii::$app->request->post('signature');
                    $Account = Yii::$app->request->post('account');
                    $Original = Yii::$app->request->post('original');
                    $Level = Yii::$app->request->post('level');
                    $AppId = Yii::$app->request->post('app_id');
                    $AppSecret = Yii::$app->request->post('app_secret');
                    $Token = Yii::$app->request->post('token');
                    $Encodingaeskey = Yii::$app->request->post('encodingaeskey');
                    $PayMchid = Yii::$app->request->post('pay_mchid'); //商户号
                    $PayKey = Yii::$app->request->post('pay_key');  //支付Key
                    $QrcodePic = $_FILES['qrcode_pic']; //二维码
                    $Avatar = $_FILES['avatar']; //头像

                    //检测图片后缀
                    $ext = pathinfo($QrcodePic['name'],PATHINFO_EXTENSION);
                    if(($ext != 'jpg')) {
                        $error_type_qrcode_pic = 1;
                    }

                    $ext1 = pathinfo($Avatar['name'],PATHINFO_EXTENSION);
                    if(($ext1 != 'jpg')) {
                        $error_type_avatar = 1;
                    }

                    if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $QrcodePic['name'])) {
                        $Qname = $QrcodePic['name'];
                        $QrcodePic['name'] = iconv("UTF-8","gb2312", $QrcodePic['name']);
                    }

                    if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $Avatar['name'])) {
                        $Aname = $Avatar['name'];
                        $Avatar['name'] = iconv("UTF-8","gb2312", $Avatar['name']);
                    }

                    $basePath = __DIR__ . '/../../uploads/image/'.$AppId;
                    //判断以公众号命名的目录是否存在
                    if(!is_dir($basePath)) {
                        mkdir($basePath);
                    }
                    if(!$error_type_qrcode_pic) { //上传二维码
                        //$ImagePath2 = '/' .$QrcodePic['name'];
                        $filePath = $basePath . '/' .$QrcodePic['name'];
                        move_uploaded_file($QrcodePic['tmp_name'],$filePath);
                    }

                    if(!$error_type_avatar) { //上传头像
                        //$ImagePath = '/' .$Avatar['name'];
                        $filePath = $basePath . '/' .$Avatar['name'];
                        move_uploaded_file($Avatar['tmp_name'],$filePath);
                    }

                    $model_save = ZdhWxAccounts::findOne(['acid'=>$Acid]);
                    $model_save->name = $Name;
                    $model_save->pay_mchid = $PayMchid;
                    $model_save->pay_key = $PayKey;
                    $model_save->signature = $Signature;
                    $model_save->account = $Account;
                    $model_save->original = $Original;
                    $model_save->level = $Level;
                    $model_save->app_id = $AppId;
                    $model_save->token = $Token;
                    $model_save->encodingaeskey = $Encodingaeskey;
                    $model_save->app_secret = $AppSecret;
                    if(!empty($QrcodePic['name']) && !empty($QrcodePic['tmp_name'])) {
                        if(isset($Qname)) {
                            $model_save->qrcode_pic = '/image/'.$AppId.'/' .$Qname;
                        } else {
                            $model_save->qrcode_pic = '/image/'.$AppId.'/' .$QrcodePic['name'];
                        }
                    }
                    if(!empty($Avatar['name']) && !empty($Avatar['tmp_name'])) {
                        if(isset($Aname)) {
                            $model_save->avatar = '/image/'.$AppId.'/' .$Aname;
                        } else {
                            $model_save->avatar = '/image/'.$AppId.'/' .$Avatar['name'];
                        }
                    }
                    $model_save->update();
                    $this->redirect(['acclist']);
                }else if(Yii::$app->getRequest()->getIsAjax()) {
                    $params = ['acid' => $Acid];
                    $model = new ZdhWxAccounts();
                    $Rows = $model->getAccountMsg($params);
                    return $this->ajaxOutput($Rows);
                } else {
                    return $this->render('accmanage',['id' => $Acid]);
                }
            } else {
                $Acid = (int) Yii::$app->request->get('id');
                $params = ['acid' => $Acid];
                $model = new ZdhWxAccounts();
                $Rows = $model->getAccountMsg($params);
                echo "<pre>";
                print_r($Rows);
            }
        }
    }

    //添加公众号
    public function actionAccadd() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(Yii::$app->request->isPost) {
                $error_type_qrcode_pic = 0;
                $error_type_avatar = 0;
                $Name = Yii::$app->request->post('gongz_name');
                $Signature = Yii::$app->request->post('signature');
                $Account = Yii::$app->request->post('account');
                $Original = Yii::$app->request->post('original');
                $Level = Yii::$app->request->post('level');
                $Token = Yii::$app->request->post('token');
                $Encodingaeskey = Yii::$app->request->post('encodingaeskey');
                $AppId = Yii::$app->request->post('app_id');
                $AppSecret = Yii::$app->request->post('app_secret');
                $PayMchid = Yii::$app->request->post('pay_mchid'); //商户号
                $PayKey = Yii::$app->request->post('pay_key');  //支付Key
                $QrcodePic = $_FILES['qrcode_pic']; //二维码
                $Avatar = $_FILES['avatar']; //头像

                //检测图片后缀
                $ext = pathinfo($QrcodePic['name'],PATHINFO_EXTENSION);
                if(($ext != 'jpg')) {
                    $error_type_qrcode_pic = 1;
                }

                $ext1 = pathinfo($Avatar['name'],PATHINFO_EXTENSION);
                if(($ext1 != 'jpg')) {
                    $error_type_avatar = 1;
                }

                $basePath = __DIR__ . '/../../uploads';
                if(!$error_type_qrcode_pic) { //上传二维码
                    $ImagePath2 = '/image/' .$QrcodePic['name'];
                    $filePath = $basePath . $ImagePath2;
                    move_uploaded_file($QrcodePic['tmp_name'],$filePath);
                }

                if(!$error_type_avatar) { //上传二维码
                    $ImagePath = '/image/' .$Avatar['name'];
                    $filePath = $basePath . $ImagePath;
                    move_uploaded_file($Avatar['tmp_name'],$filePath);
                }

                $model_save = new ZdhWxAccounts();
                $model_save->name = $Name;
                $model_save->pay_mchid = $PayMchid;
                $model_save->pay_key = $PayKey;
                $model_save->signature = $Signature;
                $model_save->account = $Account;
                $model_save->original = $Original;
                $model_save->level = $Level;
                $model_save->app_id = $AppId;
                $model_save->token = $Token;
                $model_save->encodingaeskey = $Encodingaeskey;
                $model_save->app_secret = $AppSecret;
                $model_save->created_at = time();
                if(!empty($ImagePath2)) {
                    $model_save->qrcode_pic = $ImagePath2;
                }
                if(!empty($ImagePath)) {
                    $model_save->avatar = $ImagePath;
                }
                $model_save->save();
                $this->redirect(['acclist']);
            } else {
                return $this->render('accadd');
            }
        }
    }

    public function actionAccdel() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $Id = Yii::$app->request->get('id');
            $model = ZdhWxAccounts::findOne($Id);
            $model->status = 0;
            $model->update();
            $this->redirect(['acclist']);
        }
    }

    //恢复公账号
    public function actionAccrec() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $Id = Yii::$app->request->get('id');
            $model = ZdhWxAccounts::findOne($Id);
            $model->status = 1;
            $model->update();
            $this->redirect(['acclist']);
        }
    }

    public function actionSearch() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            $search = trim(Yii::$app->request->post("search"));
            $params = ['search' => $search];
            $model = new ZdhWxAccounts();
            $Rows = $model->serAccount($params);
            return $this->render('search',['d' => $Rows]);
        }
    }
}













