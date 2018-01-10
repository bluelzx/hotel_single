<?php
namespace apps_admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use app\models\ZdhHotel;
use app\models\ZdhSysAdmin;

/**
 * Site controller
 */
class HotelController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(isset($_SESSION['acid']) && 0 == $_SESSION['acid']) {
                if(isset($_GET['acid'])) {
                    $_SESSION['s_acid'] = (int)$_GET['acid'];
                    $acid = $_SESSION['s_acid'];
                    $model_account = new ZdhSysAdmin();
                    $acid_account['acid'] = $acid;
                    $account = $model_account->getWechatAccount($acid_account);
                    $_SESSION['wx_account'] = $account['name'];
                } else if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    return $this->redirect(['account/acclist']);//公众号列表
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
                    $error_type = 0;
                    $device = [];
                    $error_type_thumb = 0;
                    $title = trim($_POST['hotel_name']);
                    //$device = $_POST['hotel_device']; //酒店设施
                    $device['cantin'] = isset($_POST['cantin']) ? $_POST['cantin'] : '';
                    $device['wifi'] = isset($_POST['wifi']) ? $_POST['wifi'] : '';
                    $device['tinchewei'] = isset($_POST['tinchewei']) ? $_POST['tinchewei'] : '';
                    $device['reshui'] = isset($_POST['reshui']) ? $_POST['reshui'] : '';
                    $device['kongtiao'] = isset($_POST['kongtiao']) ? $_POST['kongtiao'] : '';
                    $device['xiuxian'] = isset($_POST['xiuxian']) ? $_POST['xiuxian'] : '';
                    $device['xishu'] = isset($_POST['xishu']) ? $_POST['xishu'] : '';

                    //$integral = (int)$_POST['integral']; //积分
                    $level = trim($_POST['hotel_level']);
                    $phone = trim($_POST['hotel_phone']);
                    $thumb = $_FILES['thumb']; //缩略图
                    //$thumbs = $_FILES['hotel_thumbs'];
                    $addr = trim($_POST['hotel_addr']);
                    $province = trim($_POST['province']);  //省
                    $city = isset($_POST['city']) ? trim($_POST['city']) : '';  //市
                    $area = isset($_POST['area']) ? trim($_POST['area']) : '';  //区
                    $hotel_lng = trim($_POST['hotel_lng']); //经度
                    $hotel_lat = trim($_POST['hotel_lat']); //纬度
                    $description = trim($_POST['description']); //酒店介绍
                    //$content = trim($_POST['content']); //订房说明
                    //$traffic = trim($_POST['traffic']); //交通位置
                    //$sales = trim($_POST['sales']); //促销信息
                    $notice = trim($_POST['notice']); //酒店公告
                    $Hotel = new ZdhHotel();
                    $d = $Hotel->find()->select(['acid','thumbs'])->where(['acid'=>$acid])->asArray()->one();

                    //获取公众号appid
                    $param = ['acid' => $acid];
                    $AppId = $Hotel->getAppId($param);

                    //原来路径
                    //$o_path = $d['thumbs'];
                    //$o_path = unserialize($o_path);

                    //检测图片后缀
                    foreach($_FILES['hotel_thumbs']['name'] as $item) {
                        $ext = pathinfo($item,PATHINFO_EXTENSION);
                        if(($ext != 'jpg') && ($ext != 'jpng') && ($ext != 'png')) {
                            $error_type = 1;
                            break;
                        }
                    }

                    $ext = pathinfo($thumb['name'],PATHINFO_EXTENSION);
                    if(($ext != 'jpg') && ($ext != 'jpng') && ($ext != 'png')) {
                        $error_type_thumb = 1;
                    }

                    //检测文件是否通过post上传
                    foreach($_FILES['hotel_thumbs']['tmp_name'] as $item) {
                        if(!is_uploaded_file($item)) {
                            $error_type = 1;
                            break;
                        }
                    }

                    $basePath = __DIR__ . '/../../uploads/image/'.$AppId['app_id'];
                    //判断以公众号命名的目录是否存在
                    if(!is_dir($basePath)) {
                        mkdir($basePath);
                    }

                    //$imagepath = [];
                    if(!empty($d['thumbs'])) {
                        $d['thumbs'] = unserialize($d['thumbs']);
                        $imagepath = $d['thumbs'];
                        if(!$error_type) { //上传图片
                            foreach($_FILES['hotel_thumbs']['tmp_name'] as $k => $item) {
                                $filePath = $basePath . '/' .$_FILES['hotel_thumbs']['name'][$k];
                                $imagepath[] = '/image/'.$AppId['app_id'].'/' .$_FILES['hotel_thumbs']['name'][$k];
                                move_uploaded_file($item,$filePath);
                            }
                        }
                    } else {
                        $imagepath = [];
                        if(!$error_type) { //上传图片
                            foreach($_FILES['hotel_thumbs']['tmp_name'] as $k => $item) {
                                $filePath = $basePath . '/' .$_FILES['hotel_thumbs']['name'][$k];
                                $imagepath[] = '/image/'.$AppId['app_id'].'/' .$_FILES['hotel_thumbs']['name'][$k];
                                move_uploaded_file($item,$filePath);
                            }
                        }
                    }

                    $ThumbPath = '';
                    if(!$error_type_thumb) { //上传缩略图
                        $ThumbPath = '/' .$thumb['name'];
                        $filePath = $basePath . $ThumbPath;
                        move_uploaded_file($thumb['tmp_name'],$filePath);
                    }


                    //$o_path = array_merge($o_path,$imagepath);

                    $imagepath = serialize($imagepath);

                    $OpData = [
                        'title' => $title,
                        'level' => $level,
                        'show_device' => serialize($device),
                        'phone' => $phone,
                        'address' => $addr,
                        'province' => $province,
                        'city' => $city,
                        'district' => $area,
                        'lng' => $hotel_lng,
                        'lat' => $hotel_lat,
                        'notice' => $notice,
                        'description' => $description,
                        //'content' => $content,
                        //'traffic' => $traffic,
                        //'sales' => $sales,
                        //'integral' => $integral,
                    ];
                    if(!empty($thumb['name'])) {
                        $OpData['thumb'] = '/image/'.$AppId['app_id'].'/' .$thumb['name'];;
                    }
                    if(!empty($_FILES['hotel_thumbs']['name'][0])) {
                        $OpData['thumbs'] = $imagepath;
                    }

                    if(empty($d)) { //新建
                        $Hotel->acid = $acid;
                        $this->Opration($Hotel,$OpData);
                        $Hotel->insert();
                    } else {  //更新
                        $HotelObj = ZdhHotel::find()->where(['acid'=>$acid])->one();
                        $this->Opration($HotelObj,$OpData);
                        $HotelObj->update();
                    }
                }

                return $this->render("index");
            } elseif(Yii::$app->getRequest()->getIsAjax()) {
                $Hotel = new ZdhHotel();
                $d = $Hotel->find()->select(['acid','title','level','thumb','thumbs','show_device','phone','address','province','city','district','lng','lat','notice','description','content','traffic','sales','integral'])
                    ->where(['acid'=>$acid])->asArray()->one();

                $d['show_device'] = unserialize($d['show_device']);
                $d['thumbs'] = unserialize($d['thumbs']);
                //if(isset($hotel_thumbs[0]) && !empty($hotel_thumbs[0]))
                //$d['title'] = 123;
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $d;
            } else {
                return $this->render("index");
            }

        }
    }

    //删除图片
    public function actionDel() {
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if(0 == $_SESSION['acid']) {
                if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
            $id = $_GET['id'];
            $Hotel = new ZdhHotel();
            $d = $Hotel->find()->select(['acid','thumbs'])->where(['acid'=>$acid])->asArray()->one();
            $d['thumbs'] = unserialize($d['thumbs']);
            unset($d['thumbs'][$id]);
            shuffle($d['thumbs']);
            $HotelObj = ZdhHotel::find()->where(['acid'=>$acid])->one();
            $HotelObj->thumbs = serialize($d['thumbs']);
            $HotelObj->update();
            $this->redirect(['index']);
        }
    }

    //ajax删除图片
    public function actionAdel() {
        if(Yii::$app->getRequest()->getIsAjax()) {
            $id = $_POST['id'];
            $acid = $_POST['acid'];
            $Hotel = new ZdhHotel();
            $d = $Hotel->find()->select(['acid','thumbs'])->where(['acid'=>$acid])->asArray()->one();
            $d['thumbs'] = unserialize($d['thumbs']);
            unset($d['thumbs'][$id]);
            shuffle($d['thumbs']);
            $HotelObj = ZdhHotel::find()->where(['acid'=>$acid])->one();
            $HotelObj->thumbs = serialize($d['thumbs']);
            $d = $HotelObj->update();
            return $d;
        }
    }

    private function Opration($obj,$arr = []) {
        $obj->title = $arr['title'];
        $obj->level = $arr['level'];
        $obj->show_device = $arr['show_device'];
        $obj->phone = $arr['phone'];
        if(isset($arr['thumbs'])) {
            $obj->thumbs = $arr['thumbs'];
        }
        if(isset($arr['thumb'])) {
            $obj->thumb = $arr['thumb'];
        }
        $obj->address = $arr['address'];
        $obj->province = $arr['province'];
        $obj->city = $arr['city'];
        $obj->district = $arr['district'];
        $obj->lng = $arr['lng'];
        $obj->lat = $arr['lat'];
        $obj->notice = $arr['notice'];
        $obj->description = $arr['description'];
        //$obj->content = $arr['content'];
        //$obj->traffic = $arr['traffic'];
        //$obj->sales = $arr['sales'];
        //$obj->integral = $arr['integral'];
    }
}
