<?php
namespace apps_admin\controllers;

namespace apps_admin\controllers;

use app\models\ZdhHotelRoom;
use app\models\ZdhModelAttribute;
use app\models\ZdhHotelRoomType;
use app\models\ZdhHotelRoomAttr;
use Yii;
use common\controller\AdminController;
use yii\helpers\Url;

/**
 * Site controller
 */
class RoomController extends AdminController
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
                    $RoomModel = new ZdhHotelRoom();

                    //搜索条件
                    $Search = Yii::$app->request->post('sSearch');

                    $RoomType = Yii::$app->request->post('room_type');
                    $RoomNo = Yii::$app->request->post('room_no');

                    /* 初始化分页查询条件 */
                    $pageSize = $this->post('iDisplayLength');    //每页记录数
                    $page = $this->post('iDisplayStart');     //当前起始索引

                    $params = [
                        'acid' => $acid,
                        'search' => $RoomType,
                        'room_no' => $RoomNo,
                        'offset' => $page,
                        'limit' => $pageSize
                    ];
                    $d = $RoomModel->getRoomList($params);

                    $list['iTotalRecords'] = $d['count'];   //总记录数
                    $list['iTotalDisplayRecords'] = $d['count'];   //过滤之后，实际的行数
                    $list['aaData'] = $d['data'];      //表中数据
                    $list['s'] = $Search;
                    return $this->ajaxOutput($list);
                } else {
                    $model = new ZdhHotelRoomType();
                    $Raws = $model->find()->select(['name'])->where(['acid'=>$acid])->asArray()->all();
                    return $this->render('index',['rooms' => $Raws]);
                }
            } else {
                $params = ['room_no' => 201];
                $model = new ZdhHotelRoom();
                $d = $model->check($params);
                echo "<pre>";
                print_r($d);
                exit;
                $params = [
                    'acid' => 3,
                    'search' => ''
                ];
                $RoomModel = new ZdhHotelRoom();
                $d = $RoomModel->getRoomList($params);
                echo "<pre>";
                print_r($d);
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
            $model = ZdhHotelRoom::findOne(['id' => $id,'acid' => $acid]);
            $model->status=$c;
            $res = $model->update();
            $msg = $res ? $this->success('修改成功！', Url::to(['room/index'], true)) : $this->error('修改失败，请稍后再试！');
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
                        'id' => 12,
                        'acid' => $acid
                    ];
                    $model2 = new ZdhModelAttribute();
                    $AttrsNames = $model2->getRoomsAttrsName($params);
                    $RoomNo = Yii::$app->request->post("room_no"); //房间号
                    $RoomCode = Yii::$app->request->post("room_code"); //房间代码
                    $RoomType = Yii::$app->request->post("room_type"); //房间类型
                    $RoomPoint = Yii::$app->request->post("room_point"); //房间位置
                    $IsSuite = Yii::$app->request->post("is_suite"); //是否套间
                    $RoomCount = Yii::$app->request->post("room_count"); //子房间数
                    $IsSpecial = Yii::$app->request->post("is_special"); //是否特价
                    $RoomPrice = Yii::$app->request->post("room_price"); //价格
                    $Description = Yii::$app->request->post("description"); //描述

                    //状态
                    $Status = (int) $_POST['status'];
                    //房间参数
                    $tmp_str = Yii::$app->request->post();

                    foreach($AttrsNames as $name) {
                        if(2 == $name['attr_type']) {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                            }
                        } else {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                            }
                        }
                    }

                    //保存房型属性
                    $RoomAttrModel = new ZdhHotelRoomAttr();
                    $value = $RoomAttrModel->find()->select(['id','room_id','attr_id','attr_value'])->where(['room_id'=>$id])->asArray()->all(); //获取数据

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
                                $params_delete = [
                                    'id' => $com_val['id']
                                ];
                                $RoomAttrModel->deleteAttr($params_delete);
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
                                                        'room_id' => $id,
                                                        'attr_id' => $item['id'],
                                                        'attr_value' => substr($tmp_item,-0,-2) //去掉 回车符
                                                    ];
                                                } else {
                                                    $params = [
                                                        'room_id' => $id,
                                                        'attr_id' => $item['id'],
                                                        'attr_value' => $tmp_item
                                                    ];
                                                }

                                                $RoomAttrModel->saveAttr($params);
                                                unset($item['v'][$key_tmp_item]);
                                            } else {

                                            }
                                        } else { //insert
                                            if(strpos($tmp_item,"\n")){
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($tmp_item,-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $tmp_item
                                                ];
                                            }

                                            $RoomAttrModel->saveAttr($params);
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
                                                $RoomAttrModel->deleteAttr($params_delete);
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
                                        $RoomAttrModel->updateAttr($tmp_value[$ky]);
                                        unset($room_detail[$key]);
                                    }
                                }
                            } else { //单选
                                if(!empty($value)) {
                                    foreach($value as $u => $vl) {
                                        if($vl['attr_id'] == $item['id']) { //数据库中已经存在,更新
                                            if(strpos($item['v'],"\n")){
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($item['v'],-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $item['v']
                                                ];
                                            }
                                            $RoomAttrModel->updateAttr($params);
                                            unset($value[$u]);
                                            break;
                                        } else {  //新插入数据库
                                            if(strpos($item['v'],"\n")){
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => substr($item['v'],-0,-2)
                                                ];
                                            } else {
                                                $params = [
                                                    'room_id' => $id,
                                                    'attr_id' => $item['id'],
                                                    'attr_value' => $item['v']
                                                ];
                                            }
                                            $RoomAttrModel->saveAttr($params);
                                            unset($value[$u]);
                                            break;
                                        }
                                    }
                                } else {
                                    if(strpos($item['v'],"\n")){
                                        $params = [
                                            'room_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' => substr($item['v'],-0,-2)
                                        ];
                                    } else {
                                        $params = [
                                            'room_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' => $item['v']
                                        ];
                                    }
                                    $RoomAttrModel->saveAttr($params);
                                }
                            }
                        }
                    }

                    $model = ZdhHotelRoom::findOne(['acid'=>$acid,'id' => $id]);

                    $model->room_no = $RoomNo;
                    $model->room_code = $RoomCode;
                    $model->room_type_id = $RoomType;
                    $model->point = $RoomPoint;
                    $model->description = $Description;
                    $model->is_suite = empty($IsSuite) ? 0 : 1;
                    $model->child_count = $RoomCount;
                    $model->is_special = empty($IsSpecial) ? 0 : 1;
                    $model->special_price = $RoomPrice;
                    $model->status = $Status;
                    $model->update();
                    return $this->render('update',['id'=>$id]);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $params = [
                        'id' => 12,
                        'acid' => $acid
                    ];
                    $model_attribute = new ZdhModelAttribute();
                    $d = $model_attribute->getRoomsAttrs($params);
                    $model_room = new ZdhHotelRoom();
                    $res = $model_room->find()->select(['id','room_no','room_code','room_type_id','point','description','is_suite','child_count','is_special','special_price','status'])->where(['acid'=>$acid,'id'=>$id])->asArray()->one(); //获取数据

                    //获取房型名称
                    $model_room_type = new ZdhHotelRoomType();
                    $RoomTypeVal = $model_room_type->find()->select(['id','name'])->asArray()->all();

                    //获取房型属性
                    $RoomTypeModel = new ZdhHotelRoomAttr();
                    $arr = $RoomTypeModel->find()->select(['room_id','attr_id','attr_value'])->where(['room_id'=>$res['id']])->asArray()->all();
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
                    $res['room_type'] = $RoomTypeVal;
                    $res['attrs'] = $arr;
                    $res['room_detail'] = $d;
                    return $this->ajaxOutput($res);
                } else {
                    return $this->render('update',['id'=>$id]);
                }
            } else {
                /*                $model_room_type = new ZdhHotelRoomType();
                                $RoomTypeVal = $model_room_type->find()->select(['id','name'])->asArray()->all();

                                $RoomTypeModel = new ZdhHotelRoomAttr();
                                $arr = $RoomTypeModel->find()->select(['room_id','attr_id','attr_value'])->where(['room_id'=>1])->asArray()->all();
                echo "<pre>";
                print_r($RoomTypeVal);
                exit;*/
/*                $model = new ZdhModelAttribute();
                $d = $model->getRoomsAttrs();
                echo "<pre>";
                print_r($d);
                exit;*/
                $id = $_GET['id'];
                $model = new ZdhHotelRoom();
                $res = $model->find()->select(['id','room_no','room_code','room_type_id','point','description','is_suite','child_count','is_special','special_price','status'])->where(['acid'=>Yii::$app->user->identity->acid,'id'=>$id])->asArray()->one(); //获取数据
                echo "<pre>";
                print_r($res);
            }
        }
    }

    //添加房间
    public function actionAdd() {
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
                if (Yii::$app->request->isPost) {
                    $params = [
                        'id' => 12,
                        'acid' => $acid
                    ];
                    $model2 = new ZdhModelAttribute();
                    $AttrsNames = $model2->getRoomsAttrsName($params);

                    //房间号
                    $RoomNo = Yii::$app->request->post('room_no');
                    //房间代码
                    $RoomCode = Yii::$app->request->post('room_code');
                    //状态
                    $Status = Yii::$app->request->post('status');
                    //房型
                    $RoomType = Yii::$app->request->post('room_type');
                    //房间位置
                    $RoomPoint = Yii::$app->request->post('room_point');
                    //是否套间
                    $IsSuite = Yii::$app->request->post('is_suite');
                    //子房间数
                    $RoomCount = Yii::$app->request->post('room_count');
                    //是否特价
                    $IsSpecial = Yii::$app->request->post('is_special');
                    //价格
                    $RoomPrice = Yii::$app->request->post('room_price');
                    //描述
                    $Description = Yii::$app->request->post('description');
                    //房间参数
                    $tmp_str = Yii::$app->request->post();

                    foreach($AttrsNames as $name) {
                        if(2 == $name['attr_type']) {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                            }
                        } else {
                            if(isset($tmp_str[$name['id']]) && !empty($tmp_str[$name['id']])) {
                                $room_detail[$name['id']]['v'] = $tmp_str[$name['id']];
                                $room_detail[$name['id']]['t'] = $name['attr_type'];
                                $room_detail[$name['id']]['id'] = $name['id'];
                            }
                        }
                    }

                    $model = new ZdhHotelRoom();
                    $model->acid = $acid;
                    $model->room_no = $RoomNo;
                    $model->room_code = $RoomCode;
                    $model->room_type_id = $RoomType;
                    $model->point = $RoomPoint;
                    $model->description = $Description;
                    $model->is_suite = empty($IsSuite) ? 0 : 1;
                    $model->child_count = $RoomCount;
                    $model->is_special = empty($IsSpecial) ? 0 : 1;
                    $model->special_price = $RoomPrice;
                    $model->status = $Status;
                    $model->save();
                    $id = $model->attributes['id'];

                    //保存房型属性
                    $RoomAttrModel = new ZdhHotelRoomAttr();
                    if(isset($room_detail) && !empty($room_detail)) {
                        foreach($room_detail as $key => $item) {
                            if(2 == $item['t']) {  //复选
                                foreach($item['v'] as $val) {
                                    if(strpos($val,"\n")){
                                        $params = [
                                            'room_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' =>  substr($val,-0,-2)
                                        ];
                                    } else {
                                        $params = [
                                            'room_id' => $id,
                                            'attr_id' => $item['id'],
                                            'attr_value' =>  $val
                                        ];
                                    }

                                    $RoomAttrModel->saveAttr($params);
                                }
                            } else {
                                if(strpos($item['v'],"\n")){
                                    $params = [
                                        'room_id' => $id,
                                        'attr_id' => $item['id'],
                                        'attr_value' => substr($item['v'],-0,-2)
                                    ];
                                } else {
                                    $params = [
                                        'room_id' => $id,
                                        'attr_id' => $item['id'],
                                        'attr_value' => $item['v']
                                    ];
                                }

                                $RoomAttrModel->saveAttr($params);
                            }
                        }
                    }

                    $this->redirect(['index']);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    //获取房型名称
                    $model_room_type = new ZdhHotelRoomType();
                    $RoomTypeVal = $model_room_type->find()->select(['id','name'])->asArray()->all();
                    $params = [
                        'id' => 12,
                        'acid' => $acid
                    ];
                    $model = new ZdhModelAttribute();
                    $d = $model->getRoomsAttrs($params);
                    $res['room_type'] = $RoomTypeVal;
                    $res['room_detail'] = $d;
                    return $this->ajaxOutput($res);
                } else {
                    return $this->render('add');
                }
            } else {
                $model = new ZdhModelAttribute();
                $d = $model->getRoomsAttrs();
                echo "<pre>";
                print_r($d);
            }
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
            $params = [
                'id' => $id,
                'acid' => $acid
            ];
            $model = new ZdhHotelRoom();
            $del = $model->del($params);
            $msg = $del ? $this->success('删除成功！', Url::to(['room/index'], true)) : $this->error('删除失败，请稍后再试！');
            return $msg;
        }
    }

    //房型、房号搜索
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
            $RoomType = Yii::$app->request->post('room_type');
            $RoomNo = Yii::$app->request->post('room_no');
            $params = [
                'room_type' => $RoomType,
                'room_no' => $RoomNo,
                'acid' => $acid
            ];
            $model = new ZdhHotelRoom();
            $Raw = $model->search($params);
            return $this->render('search',['rows' => $Raw]);
        }
    }

    //检测房间号是否已经存在
    public function actionCheckno() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $room_no = $_POST['room_no'];
            $params = ['room_no' => $room_no];
            $model = new ZdhHotelRoom();
            $d = $model->check($params);
            $d = empty($d['id']) ? 0 : 1;
            return $this->ajaxOutput($d);
        }
    }

    //检测房间代码是否已经存在
    public function actionCheckcode() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $room_code = $_POST['room_code'];
            $params = ['room_code' => $room_code];
            $model = new ZdhHotelRoom();
            $d = $model->check($params);
            $d = empty($d['id']) ? 0 : 1;
            return $this->ajaxOutput($d);
        }
    }
}
