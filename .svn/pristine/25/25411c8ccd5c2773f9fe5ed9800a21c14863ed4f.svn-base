<?php
namespace apps_admin\controllers;

use app\models\ZdhModel;
use app\models\ZdhModelAttribute;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\controller\AdminController;
use yii\helpers\Url;

/**
 * Site controller
 */
class CategoryController extends AdminController
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
                if (Yii::$app->request->isPost) {
                    $model = new ZdhModel();

                    /* 初始化分页查询条件 */
                    $d = $model->find()->select(['id','name','desc'])->asArray()->all();
                    //获取属性数量
                    foreach($d as $k => $val) {
                        $params = ['acid' => $acid,'type_id' => $val['id']];
                        $count = $model->getAttrList($params);
                        $d[$k]['count'] = $count['count'];
                    }

                    $list['aaData'] = $d;
                    return $this->ajaxOutput($list);
                } else {
                    return $this->render('index');
                }
            } else {
                $model = new ZdhModel();
                $d = $model->find()->select(['id','name','desc'])->asArray()->all();
                echo "<pre>";
                print_r($d);
                exit;
                $params = ['acid' => Yii::$app->user->identity->acid,'type_id' => 2];
                $d = $model->getAttrList($params);
                echo "<pre>";
                print_r($d);
                echo "<pre>";
                echo date('Y-m-d H:i:s',time());
            }
        }
    }

    //检测模型名称
    public function actionModelname() {
        set_time_limit(0);
        if(Yii::$app->getRequest()->getIsAjax()) {
            $name = $_POST['model_name'];
            $model = new ZdhModel();
            $param['name'] = $name;
            $d = $model->check($param);
            return $this->ajaxOutput($d);
        }
    }

    //添加模型
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
                $ModelName = Yii::$app->request->post('model_name');
                $Desc = Yii::$app->request->post('desc');
                $model = new ZdhModel();
                $model->acid = $acid;
                $model->name = $ModelName;
                $model->desc = $Desc;
                $model->created_at = date('Y-m-d H:i:s',time());
                $model->save();
                $this->redirect(['index']);
            } else {
                return $this->render('add');
            }
        }
    }

    //修改模型
    public function actionModify() {
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
                $id = Yii::$app->request->get('id');
                if (Yii::$app->request->isPost) {
                    $Name = Yii::$app->request->post('model_name');
                    $Desc = Yii::$app->request->post('desc');
                    $model = ZdhModel::findOne(['id' => $id]);
                    $model->name = $Name;
                    $model->desc = $Desc;
                    $model->update();
                    $this->redirect(['index']);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $model = new ZdhModel();
                    $d = $model->find()->select(['name','desc'])->where(['id' => $id])->asArray()->one();
                    return $this->ajaxOutput($d);
                } else {
                    return $this->render('modify',['id' => $id]);
                }
            } else {
                $model = new ZdhModel();
                $d = $model->find()->select(['name','desc'])->where(['id' => 2])->asArray()->one();
                echo "<pre>";
                print_r($d);
                echo "<pre>";
            }
        }
    }

    //模型对应属性列表
    public function actionAttrList() {
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
            $Id = Yii::$app->request->get('id');
            if(Yii::$app->getRequest()->getIsAjax()) {
                $Id = Yii::$app->request->get('id');
                $model = new ZdhModel();
                $params = ['acid' => $acid,'type_id' => $Id];
                $d = $model->getAttrList($params);
                return $this->ajaxOutput($d);
            } else {
                return $this->render('attr-list',['id' => $Id]);
            }
        }
    }

    //添加属性
    public function actionAddAttr () {
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
            $TypeId = Yii::$app->request->get('type_id');
            if (Yii::$app->request->isPost) {
                $OptionsValue = Yii::$app->request->post('attr_value');
                $AttrName = Yii::$app->request->post('attr_name');
                $Type = Yii::$app->request->post('type');
                $AttrSuffixText = Yii::$app->request->post('attr_suffix_text');

                $model = new ZdhModelAttribute();
                $model->acid = $acid;
                $model->attr_name = $AttrName;
                $model->attr_option_values = $OptionsValue;
                $model->attr_type = $Type;
                $model->attr_suffix_text = $AttrSuffixText;
                $model->type_id = $TypeId;
                $model->save();
                $this->redirect(['attr-list','id'=>$TypeId]);
            } else {
                return $this->render('add-attr',['type_id' => $TypeId]);
            }
        }
    }

    //编辑属性
    public function actionEditAttr() {
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
                $Id = Yii::$app->request->get('id');
                $TypeId = Yii::$app->request->get('type_id');
                if (Yii::$app->request->isPost) {
                    $AttrName = Yii::$app->request->post('attr_name');
                    $AttrType = Yii::$app->request->post('type');
                    $AttrOptionValues = Yii::$app->request->post('attr_value');
                    $AttrSuffixText = Yii::$app->request->post('attr_suffix_text');
                    $model = ZdhModelAttribute::findOne(['acid' => $acid,'id' => $Id]);
                    $model->attr_name = $AttrName;
                    $model->attr_type = $AttrType;
                    $model->attr_option_values = $AttrOptionValues;
                    $model->attr_suffix_text = $AttrSuffixText;
                    $model->update();
                    $this->redirect(['attr-list','id'=>$TypeId]);
                } else if(Yii::$app->getRequest()->getIsAjax()) {
                    $model = new ZdhModelAttribute();
                    $d = $model->find()->where(['acid' => $acid,'id' => $Id])->asArray()->one();
                    return $this->ajaxOutput($d);
                } else {
                    return $this->render('edit-attr',['id' => $Id,'type_id' => $TypeId]);
                }
            } else {

            }
        }
    }

    //删除属性
    public function actionDeleteAttr() {
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

            $Id = Yii::$app->request->get('id');
            $TypeId = Yii::$app->request->get('type_id');
            $model = ZdhModelAttribute::findOne(['acid' => $acid,'id' => $Id]);
            $del = $model->delete();
            $msg = $del ? $this->success('删除成功！', Url::to(['category/attr-list','id'=>$TypeId],true)) : $this->error('删除失败，请稍后再试！');
            return $msg;
        }
    }
}

















