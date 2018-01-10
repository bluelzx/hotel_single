<?php
namespace apps_admin\controllers;

use app\models\ZdhHotelRoomType;
use app\models\ZdhHotelRoomTypePrice;
use app\models\ZdhModelAttribute;
use app\models\ZdhHotelRoomTypeAttr;
use Yii;
use common\controller\AdminController;
use app\models\ZdhHotel;
use yii\helpers\Url;

/**
 * Site controller
 */
class RoomTypeController extends AdminController
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
                    $RoomTypeModel = new ZdhHotelRoomType();
                    //搜索条件
                    $Search = Yii::$app->request->post('sSearch');

                    /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引

                    $params = [
                        'acid' => $acid,
                        'search' => $Search,
                        'offset' => $page,
                        'limit' => $pageSize
                    ];
                    $d = $RoomTypeModel->getRoomTypeList($params);

                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    $list['s'] = $Search;
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render('index');
                }
            } else {
                $PriceExists = ZdhHotelRoomTypePrice::find()->where(['room_type_id'=>100])->asArray()->all();
                echo "<pre>";
                print_r($PriceExists);
                exit;

                $RoomTypeModel = new ZdhHotelRoomType();
                //$d = $RoomTypeModel->find()->select(['name','thumb','attrs','room_num','sales','other','display_order','status'])->where(['acid'=>Yii::$app->user->identity->acid])->asArray()->all();
                //var_dump(Yii::$app->user->acid);
                $params = [
                    'acid' => Yii::$app->user->identity->acid,
                    'search' => '',
                    'offset' => 0,
                    'limit' => 10
                ];
                $d = $RoomTypeModel->getRoomTypeList($params);
                echo "<pre>";
                print_r($d);
                echo "<pre>";
/*                $f = fopen(__DIR__.'/ajax.txt','w');
                fwrite($f,'wuyidong',8);
                fclose($f);
                $f = fopen(__DIR__.'/ajax.txt','r');
                $content = fread($f,8);
                fclose($f);
                //echo __DIR__;
                echo $content;*/
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
            $model = ZdhHotelRoomType::findOne(['id' => $id,'acid' => $acid]);
            $model->status=$c;
            $res = $model->update();
            $msg = $res ? $this->success('修改成功！', Url::to(['room-type/index'], true)) : $this->error('修改失败，请稍后再试！');
            return $msg;
        }

    }

    public function actionDel() {
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
            //确认房价中是否有对应的房型，如果有，则不能删除
            $PriceExists = ZdhHotelRoomTypePrice::find()->where(['room_type_id'=>$id])->asArray()->all();
            if(!empty($PriceExists)) { //有房价存在
                $msg = 0 ? $this->success('删除成功！', Url::to(['room-type/index'], true)) : $this->error('删除失败，请先删除该房型的所有房价！');
                return $msg;
            }
            $params = [
                'id' => $id,
                'acid' => $acid
            ];
            $model = new ZdhHotelRoomType();
            $del = $model->del($params);
            $msg = $del ? $this->success('删除成功！', Url::to(['room-type/index'], true)) : $this->error('删除失败，请稍后再试！');
            return $msg;
        }
    }

    //更新
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
                    $params = [
                        'id' => 11,
                        'acid' => $acid
                    ];
                    $model2 = new ZdhModelAttribute();
                    $AttrsNames = $model2->getRoomsAttrsName($params);

                    $error_type_thumb = 0;
                    //房型名称
                    $RoomName = trim($_POST['room_name']);

                    //缩略图
                    if(!empty($_FILES['thumb']['name'])) {
                        $Thumb = $_FILES['thumb'];
                    }

                    //房间数量
                    $RoomCount = (int) $_POST['room_count'];
                    //促销信息
                    //$Sales = trim($_POST['sales']);
                    //其他信息
                    //$Other = trim($_POST['other']);
                    //排序
                    $DisplayOrder = (int) $_POST['display_order'];
                    //状态
                    $Status = (int) $_POST['status'];
                    //房间参数
                    $tmp_str = Yii::$app->request->post();

                    $attrs = [];
                    foreach($AttrsNames as $name) {
                        if(2 == $name['attr_type']) {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                                $attrs[$name['attr_name']] = implode(',',$tmp_str[$name['id']]);
                            }

                        } else {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                                $attrs[$name['attr_name']] = $tmp_str[$name['id']];
                            }
                        }
                    }
/*                    echo "<pre>";
                    print_r($room_detail);*/
                    //保存房型属性
                    $RoomTypeAttrModel = new ZdhHotelRoomTypeAttr();
                    $value = $RoomTypeAttrModel->find()->select(['id','room_type_id','attr_id','attr_value'])->where(['room_type_id'=>$id])->asArray()->all(); //获取数据
/*                    echo "<pre>";
                    print_r($value);*/
                    //exit;
                    if(isset($room_detail) && !empty($room_detail)) {
                        foreach($value as $key_com_val => $com_val) {  //删除所有checkbox
                            $FlagDelBox = 0;  // 0:删除
                            foreach($room_detail as $key_room_detail => $detail_val) {
                                if($com_val['attr_id'] == $detail_val['id']) {
                                    $FlagDelBox = 1;
                                    break;
                                } else {
                                    $FlagDelBox = 0;
                                }
                            }
                            if(!$FlagDelBox) {
                                //需要unset调value的值
                                unset($value[$key_com_val]);
                                $params_delete = [
                                    'id' => $com_val['id']
                                ];
                                $RoomTypeAttrModel->deleteAttr($params_delete);
                            }
                        }

                        foreach($room_detail as $key => $item) {
                            if(2 == $item['t']) {  //复选
                                $tmp_value = [];
                                foreach($value as $kt => $v) {   //已选的复选项从数据库中
                                    if($v['attr_id'] == $item['id']) {
                                        $tmp_value[] = $v;
                                        unset($value[$kt]);
                                    }
                                }
                                if(count($tmp_value) < count($item['v'])) {  //新增
                                        foreach($item['v'] as $key_tmp_item => $tmp_item) {
                                        $FlagUpdate = 0;  // 0:插入新数据  1:更新
                                        if(isset($tmp_value) && !empty($tmp_value)) {
                                            foreach($tmp_value as $key_d_tmp_val => $d_tmp_val) {
                                                if($d_tmp_val['attr_value'] == $tmp_item) {  //update  如果数据库中已经保存有该值，则进行更新
                                                    //$RoomTypeAttrModel->updateAttr($d_tmp_val);
                                                    unset($tmp_value[$key_d_tmp_val]);
                                                    unset($item['v'][$key_tmp_item]);
                                                    $FlagUpdate = 1;
                                                    break;
                                                } else {  //insert  如果该值为新值，则插入到数据库
                                                    $FlagUpdate = 0;
                                                    break;
                                                }
                                            }
                                            if(!$FlagUpdate) {  //插入
                                                if(strpos($tmp_item,"\n")){
                                                    $params = [
                                                        'room_type_id' => $id,
                                                        'attr_id' => $item['id'],
                                                        'attr_value' => substr($tmp_item,-0,-2) //去掉 回车符
                                                    ];
                                                } else {
                                                    $params = [
                                                        'room_type_id' => $id,
                                                        'attr_id' => $item['id'],
                                                        'attr_value' => $tmp_item
                                                    ];
                                                }

                                                $RoomTypeAttrModel->saveAttr($params);
                                                unset($item['v'][$key_tmp_item]);
                                            } else {

                                            }
                                        } else { //insert
                                            if(strpos($tmp_item,"\n")){
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($tmp_item,-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $tmp_item
                                                ];
                                            }

                                            $RoomTypeAttrModel->saveAttr($params);
                                            unset($item['v'][$key_tmp_item]);
                                            //break;
                                        }
                                    }
                                } else if(count($tmp_value) > count($item['v'])) { //删除
                                    foreach($tmp_value as $key_d_tmp_val => $d_tmp_val) {
                                        $FlagDelete = 0; // 0:删除  1:更新
                                        if(isset($item['v']) && !empty($item['v'])) {
                                            foreach($item['v'] as $key_tmp_item => $tmp_item) {
                                                if($d_tmp_val['attr_value'] == $tmp_item) {  //update
                                                    $FlagDelete = 1;
                                                    break;
                                                } else {  //delete
                                                    $FlagDelete = 0;
                                                }
                                            }
                                            if(!$FlagDelete) { //delete
                                                $params_delete = [
                                                    'id' => $tmp_value[$key_d_tmp_val]['id']
                                                ];
                                                $RoomTypeAttrModel->deleteAttr($params_delete);
                                            }
                                        }
                                    }
                                } else {
                                    foreach($item['v'] as $ky => $val) {
                                        if(strpos($val,"\n")){
                                            $tmp_value[$ky]['attr_value'] = substr($val,-0,-2);
                                        } else {
                                            $tmp_value[$ky]['attr_value'] = $val;
                                        }
                                        $RoomTypeAttrModel->updateAttr($tmp_value[$ky]);
                                    }
                                    unset($room_detail[$key]);
                                }
                            } else { //单选
                                if(!empty($value)) {
                                    foreach($value as $u => $vl) {
                                        if($vl['attr_id'] == $item['id']) { //数据库中已经存在,更新
/*                                            echo "1<br>";
                                            echo "<pre>";
                                            print_r($vl);
                                            print_r($item);*/
                                            if(strpos($item['v'],"\n")){
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($item['v'],-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $item['v']
                                                ];
                                            }
                                            $RoomTypeAttrModel->updateAttr($params);
                                            unset($value[$u]);
                                            break;
                                        } else {
/*                                            echo "2<br>";
                                            echo "<pre>";
                                            print_r($vl);
                                            print_r($item);*/
                                            if(strpos($item['v'],"\n")){
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($item['v'],-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_type_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $item['v']
                                                ];
                                            }
                                            $RoomTypeAttrModel->saveAttr($params);
                                            unset($value[$u]);
                                            break;
                                        }
                                    }
                                    //exit;
                                } else {
                                    if(strpos($item['v'],"\n")){
                                        $params = [
                                            'room_type_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' => substr($item['v'],-0,-2)
                                        ];
                                    } else {
                                        $params = [
                                            'room_type_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' => $item['v']
                                        ];
                                    }
                                    $RoomTypeAttrModel->saveAttr($params);
                                }
                            }
                        }
                    }

                    if(isset($Thumb) && !empty($Thumb['name']) && !empty($Thumb['tmp_name'])) {
                        //处理中文名字的图片
                        if (preg_match("/([\x81-\xfe][\x40-\xfe])/", $Thumb['name'])) {
                            $Tname = $Thumb['name'];
                            $Thumb['name'] = iconv("UTF-8","gb2312", $Thumb['name']);
                        }
                        $Hotel = new ZdhHotel();
                        //获取公众号appid
                        $param = ['acid' => $acid];
                        $AppId = $Hotel->getAppId($param);
                        //检测上传图片
                        $ext = pathinfo($Thumb['name'],PATHINFO_EXTENSION);
                        if(($ext != 'jpg') && ($ext != 'jpng') && ($ext != 'png')) {
                            $error_type_thumb = 1;
                        }

                        $basePath = __DIR__ . '/../../uploads/image/'.$AppId['app_id'];
                        //判断以公众号命名的目录是否存在
                        if(!is_dir($basePath)) {
                            mkdir($basePath);
                        }

                        if(!$error_type_thumb) { //上传缩略图
                            $filePath = $basePath . '/' .$Thumb['name'];
                            move_uploaded_file($Thumb['tmp_name'],$filePath);
                        }
                    }

                    $model = ZdhHotelRoomType::findOne(['acid'=>$acid,'id' => $id]);
                    //$model->attrs = serialize($room_detail);
                    if(!empty($Thumb['name']) && !empty($Thumb['tmp_name'])) {
                        if(isset($Tname)) {
                            $model->thumb = '/image/'.$AppId['app_id'].'/' .$Tname;
                        } else {
                            $model->thumb = '/image/'.$AppId['app_id'].'/' .$Thumb['name'];
                        }
                    }
                    $model->name = $RoomName;
                    $model->attrs = serialize($attrs);
                    $model->room_num = $RoomCount;
                    //$model->sales = $Sales;
                    //$model->other = $Other;
                    $model->display_order = $DisplayOrder;
                    $model->status = $Status;
                    $model->update();
                    return $this->render('update',['id'=>$id]);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $params = [
                        'id' => 11,
                        'acid' => $acid
                    ];
                    $model = new ZdhModelAttribute();
                    $d = $model->getRoomsAttrs($params);
                    $model = new ZdhHotelRoomType();
                    $res = $model->find()->select(['id','name','thumb','attrs','room_num','sales','other','display_order','status'])->where(['acid'=>$acid,'id'=>$id])->asArray()->one(); //获取数据

                    //获取房型属性
                    $RoomTypeModel = new ZdhHotelRoomTypeAttr();
                    $arr = $RoomTypeModel->find()->select(['room_type_id','attr_id','attr_value'])->where(['room_type_id'=>$res['id']])->asArray()->all();
                    //$arr[0]['attr_value'] = substr($arr[0]['attr_value'],-0,-2);
                    //获取房型属性的attr_type
                    $AttributeModel = new ZdhModelAttribute();
                    $AttrType = $AttributeModel->getRoomsAttrsName($params);
                    foreach($arr as $k => $item) {
                        foreach($AttrType as $item_type) {
                            if($item['attr_id'] == $item_type['id']) {
                                $arr[$k]['id'] = $item_type['attr_type'];
                                break;
                            }
                        }
                    }

                    $res['attrs'] = $arr;
                    $res['room_detail'] = $d;
                    return $this->ajaxOutput($res);
                } else {
                    return $this->render('update',['id'=>$id]);
                }
            } else {
                $params = [
                    'id' => 11
                ];
                $AttributeModel = new ZdhModelAttribute();
                $AttrType = $AttributeModel->getRoomsAttrsName($params);
                echo "<pre>";
                print_r($AttrType);

                $id = 46;
                //获取房型属性
                $RoomTypeModel = new ZdhHotelRoomTypeAttr();
                $res = $RoomTypeModel->find()->select(['room_type_id','attr_id','attr_value'])->where(['room_type_id'=>$id])->asArray()->all();
                //$res[0]['attr_value'] = substr($res[0]['attr_value'],-0,-2);
                echo "<pre>";
                print_r($res);
                foreach($res as $k => $item) {
                    foreach($AttrType as $item_type) {
                        if($item['attr_id'] == $item_type['id']) {
                            $res[$k]['id'] = $item_type['attr_type'];
                            break;
                        }
                    }
                }
                echo "<pre>";
                print_r($res);
                exit;



                $model = new ZdhHotelRoomType();
                $res = $model->find()->select(['id','name','thumb','attrs','room_num','sales','other','display_order','status'])->where(['acid'=>Yii::$app->user->identity->acid,'id'=>$id])->asArray()->one(); //获取数据
                echo "<pre>";
                print_r($res);
                exit;
                $tmp_attr = unserialize($res['attrs']);
                $arr = [];
                foreach($tmp_attr as $k => $val) {
                    $arr[] = $val;
                }
                $res['attrs'] = $arr;
/*                $model = new ZdhModelAttribute();
                $d = $model->getRoomsAttrs();*/
                echo "<pre>";
                print_r($res);
                echo "<pre>";
            }
        }

    }

    public function actionAdd() {
        set_time_limit(0);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            define('DEBUG',1);
            if(0 == $_SESSION['acid']) {
                if(isset($_SESSION['s_acid'])) {
                    $acid = $_SESSION['s_acid'];
                } else {
                    return $this->redirect(['account/acclist']);//公众号列表
                }
            } else {
                $acid = Yii::$app->user->identity->acid;
            }
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
                    $params = [
                        'id' => 11,
                        'acid' => $acid
                    ];
                    $model2 = new ZdhModelAttribute();
                    $AttrsNames = $model2->getRoomsAttrsName($params);

                    $error_type_thumb = 0;
                    //房型名称
                    $RoomName = trim($_POST['room_name']);
                    //缩略图
                    $Thumb = $_FILES['thumb'];
                    //房间数量
                    $RoomCount = (int) $_POST['room_count'];
                    //促销信息
                    //$Sales = trim($_POST['sales']);
                    //其他信息
                    //$Other = trim($_POST['other']);
                    //排序
                    $DisplayOrder = (int) $_POST['display_order'];
                    //状态
                    $Status = (int) $_POST['status'];

                    //序列化房间参数
                    $room_detail = [];
                    $attrs = [];
                    //房间参数
                    $tmp_str = Yii::$app->request->post();

                    foreach($AttrsNames as $name) {
                        if(2 == $name['attr_type']) {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                                $attrs[$name['attr_name']] = implode(',',$tmp_str[$name['id']]);
                                //$attrs[$name['attr_name']] = $tmp_str[$name['id']];
                            }
                        } else {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                                $attrs[$name['attr_name']] = $tmp_str[$name['id']];
                            }
                        }
                    }

                    if(!empty($Thumb['name']) && !empty($Thumb['tmp_name'])) {
                        $Hotel = new ZdhHotel();
                        //获取公众号appid
                        $param = ['acid' => $acid];
                        $AppId = $Hotel->getAppId($param);
                        //检测上传图片
                        $ext = pathinfo($Thumb['name'],PATHINFO_EXTENSION);
                        if(($ext != 'jpg') && ($ext != 'jpng') && ($ext != 'png')) {
                            $error_type_thumb = 1;
                        }

                        $basePath = __DIR__ . '/../../uploads/image/'.$AppId['app_id'];
                        //判断以公众号命名的目录是否存在
                        if(!is_dir($basePath)) {
                            mkdir($basePath);
                        }
                        if(!$error_type_thumb) { //上传缩略图
                            $filePath = $basePath . '/' .$Thumb['name'];
                            move_uploaded_file($Thumb['tmp_name'],$filePath);
                        }
                    }

                    $model = new ZdhHotelRoomType();
                    $model->acid = $acid;
                    //$model->attrs = serialize($room_detail);
                    if(!empty($Thumb['name']) && !empty($Thumb['tmp_name'])) {
                        $model->thumb = '/image/'.$AppId['app_id'].'/' .$Thumb['name'];
                    }
                    $model->name = $RoomName;
                    $model->attrs = serialize($attrs);
                    $model->room_num = $RoomCount;
                    //$model->sales = $Sales;
                    //$model->other = $Other;
                    $model->display_order = $DisplayOrder;
                    $model->status = $Status;
                    $model->save();
                    $id = $model->attributes['id'];

                    //保存房型属性
                    $RoomTypeAttrModel = new ZdhHotelRoomTypeAttr();
                    if(isset($room_detail) && !empty($room_detail)) {
                        foreach($room_detail as $key => $item) {
                            if(2 == $item['t']) {  //复选
                                foreach($item['v'] as $val) {
                                    if(strpos($val,"\n")){
                                        $params = [
                                            'room_type_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' =>  substr($val,-0,-2)
                                        ];
                                    } else {
                                        $params = [
                                            'room_type_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' =>  $val
                                        ];
                                    }

                                    $RoomTypeAttrModel->saveAttr($params);
                                }
                            } else {
                                if(strpos($item['v'],"\n")){
                                    $params = [
                                        'room_type_id' => $id,
                                        'attr_id' => $item['id'],
                                        'attr_value' => substr($item['v'],-0,-2)
                                    ];
                                } else {
                                    $params = [
                                        'room_type_id' => $id,
                                        'attr_id' => $item['id'],
                                        'attr_value' => $item['v']
                                    ];
                                }

                                $RoomTypeAttrModel->saveAttr($params);
                            }
                        }
                    }

                    $this->redirect(['index']);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $params = [
                        'id' => 11,
                        'acid' => $acid
                    ];
                    $model = new ZdhModelAttribute();
                    $d = $model->getRoomsAttrs($params);
                    return $this->ajaxOutput($d);
                } else {
                    return $this->render('add');
                }
            } else {
/*                $model = new ZdhHotelRoomType();
                $param['name'] = "aa";
                $d = $model->check($param);
                echo "<pre>";
                print_r($d);
                exit;*/
                $params = [
                    'id' => 11,
                    'acid' => $acid
                ];
                $model = new ZdhModelAttribute();
                $d = $model->getRoomsAttrs($params);
                echo "<pre>";
                print_r($d);
            }
        }
    }

    public function actionCheckroom() {
        set_time_limit(0);
        if(isset($_SESSION['acid']) && 0 == $_SESSION['acid']) {
            if(isset($_SESSION['s_acid'])) {
                $acid = $_SESSION['s_acid'];
            } else {
                return $this->redirect(['account/acclist']);//公众号列表
            }
        } else {
            $acid = Yii::$app->user->identity->acid;
        }
        if(Yii::$app->getRequest()->getIsAjax()) {
            $name = $_POST['room_name'];
            $model = new ZdhHotelRoomType();
            $param['name'] = $name;
            $param['acid'] = $acid;
            $d = $model->check($param);
            return $this->ajaxOutput($d);
        }
    }


    /**
     * 获取model实体对象
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected
    function findModel($id)
    {
        if (($model = ZdhHotelRoomType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
