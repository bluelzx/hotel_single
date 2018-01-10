<?php
namespace apps_admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\ZdhSysAdmin;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\helpers\Url;
use yii\base\Object;

/**
 * Site controller
 */
class LoginController extends Controller
{
    
    public $enableCsrfValidation=false;
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        $this->layout=false;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //插入登陆时间和登陆ip
            $model_admin = ZdhSysAdmin::findOne(['acid'=>Yii::$app->user->identity->acid]);
            $model_account = new ZdhSysAdmin();
            $acid['acid'] = Yii::$app->user->identity->acid;
            $account = $model_account->getWechatAccount($acid);
            if(isset($account) && !empty($account['name'])) {
                $_SESSION['wx_account'] = $account['name'];
            } else {
                $_SESSION['wx_account'] = "超级管理员";
            }

            $_SESSION['acid'] = Yii::$app->user->identity->acid;
            $_SESSION['username'] = Yii::$app->user->identity->username;
            //echo  $_SESSION['acid'];die; 
            $model_admin->last_login_time = date('Y-m-d H:i:s',time());
            $model_admin->last_login_ip = $_SERVER['REMOTE_ADDR'];
            $model_admin->update();
            if(!$_SESSION['acid']) {
                $this->redirect(['account/acclist']);//公众号列表
            } else {
                $this->redirect(['hotel/index']);
            }
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(Url::to(['login/index']));
    }
    
    
    public function actionUpdate(){
       
        define('DEBUG',1);
        if(!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0 ){
            $this->redirect("login/index");
        }else {
            if(0 == $_SESSION['acid']){
                $acid=$_SESSION['s_acid'];
            }else {
                $acid=\Yii::$app->user->identity->acid;
            }
        }
         return $this->render('update');
    }
    
    public function actionUpdatedo(){
        define('DEBUG',1);
        if(!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0 ){
            $this->redirect("login/index");
        }else {
            if(0 == $_SESSION['acid']){
                $acid=$_SESSION['s_acid'];
            }else {
                $acid=\Yii::$app->user->identity->acid;
            }
        }
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        $confirmpass=$_POST['comfirmpass'];
       
        $_SESSION['username'] = Yii::$app->user->identity->username;
        
          $model=new User();
         
         
        
        $_SESSION['password'] = Yii::$app->user->identity->password_hash;
       
        $d= Yii::$app->security->validatePassword($oldpass, $_SESSION['password']);
        
        //print_r($d);die;//输出是1代表验证正确了
        if(!empty($d)){
            if($newpass==$confirmpass){
                $secret=$model->setPassword($confirmpass);
                $connect= \Yii::$app->db;
                $sql2="UPDATE zdh_sys_admin SET password_hash ='{$secret}' WHERE username = '{$_SESSION['username']}' ";
                $command2 = $connect->createCommand($sql2);
                $command2->execute();
                echo "<script>";
                echo "alert('密码修改成功');";
                echo "history.back();";
                echo "</script>";    
               // $this->redirect(array('login/update'));
            }else {
                echo "<script>";
                echo "alert('两次密码输入不一致');";
                echo "history.back();";
                echo "</script>";
                exit;
            }
        }else {
                    echo "<script>";
                    echo "alert('密码输入错误');";
                    echo "history.back();";
                    echo "</script>";
                    exit;
        }
       
      //return $this->render('updatedo');
    }
    public function actionAjax(){
        $oldpass=$_REQUEST['data'];
        $_SESSION['password'] = Yii::$app->user->identity->password_hash;
        $d= Yii::$app->security->validatePassword($oldpass, $_SESSION['password']);
        if(!empty($d)){
           echo 1; 
        }else {
           echo 2;
        }
    }
}
