<?php
namespace apps_admin\controllers;

use app\models\WxMenu;
use app\models\ZdhWxAccounts;
use app\models\ZdhWxMenu;
use app\models\ZdhWxMenuClick;
use common\components\wechat\Wechat;
use common\controller\AdminController;
use Yii;
use yii\helpers\Url;

/**
 */
class WxMenuController extends AdminController
{

    public $acid;

    public function init()
    {
        $this->request = Yii::$app->request;
        $this->response = Yii::$app->response;

        set_time_limit(0);
        define('DEBUG', 1);
        if (!isset(Yii::$app->user->id) || Yii::$app->user->id <= 0) {
            $this->redirect(['login/index']);
        } else {
            if (DEBUG) {
                if (0 == $_SESSION['acid']) {
                    $this->acid = $_SESSION['s_acid'];
                } else {
                    $this->acid = Yii::$app->user->identity->acid;
                }
            }
        }
    }


    /**
     * 自定义菜单列表页
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $query = ZdhWxMenu::find();

            /* 初始化分页查询条件 */
            $pageSize = $this->post('iDisplayLength');    //每页记录数
            $maxRows = $query->where(['acid' => $this->acid])->count();           //总记录数
            //$page = $this->post('iDisplayStart');     //当前起始索引
            $field = ['zdh_wx_menu.id', 'zdh_wx_menu.pid', 'zdh_wx_menu.click_id', 'name', 'zdh_wx_menu.type', 'title', 'zdh_wx_menu.created_at', 'zdh_wx_menu.sort']; //查询字段
            $order = $this->post('iSortCol_0') != null ? $field[intval($this->post('iSortCol_0'))] . ' ' . $this->post('sSortDir_0') : 'sort desc';//排序
            $displayRecords = $query->where(['acid' => $this->acid])->count();
            $data = $query->joinWith(['menuClick'])->select($field)->where(['zdh_wx_menu.acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->limit(25)->offset(0)->asArray()->all(); //获取数据

            /* 返回数据 */
            $list['iTotalRecords'] = $maxRows;   //总记录数
            $list['iTotalDisplayRecords'] = $displayRecords;   //过滤之后，实际的行数

            //数据level排序
            $n_data = [];
            foreach ($data as $k => $v) {
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
                if ($v['pid'] == 0) {
                    $n_data[] = $v;
                    foreach ($data as $subk => $subv) {
                        if ($subv['pid'] == $v['id']) {
                            $subv['name'] = '&nbsp;&nbsp;&nbsp;—├ ' . $subv['name'];
                            $n_data[] = $subv;
                        }
                    }
                }
            }
            $list['aaData'] = $n_data;      //表中数据

            return $this->ajaxOutput($list);
        } else {
            return $this->render('index');
        }
    }

    /**
     * 添加自定义菜单
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $model = new ZdhWxMenu();

            $model->scenario = 'add';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->success('添加成功！', Url::to(['wx-menu/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            //所属父级菜单
            $list = ZdhWxMenu::find()->where(['acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->asArray()->all();
            $menu_list[] = ['id' => 0, 'name' => '一级菜单'];
            foreach ($list as $item) {
                if ($item['pid'] == 0) {
                    $menu_list[] = ['id' => $item['id'], 'name' => '├ ' . $item['name']];
                    foreach ($list as $subitem) {
                        if ($subitem['pid'] = $item['id']) {
                            $n_list[] = ['id' => $subitem['id'], 'name' => '—├ ' . $subitem['name']];
                        }
                    }
                }
            }
            //所属素材
            $menu_click = ZdhWxMenuClick::find()->where(['acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->asArray()->all();
            return $this->render('edit', ['menu_list' => $menu_list, 'menu_click' => $menu_click, 'acid' => $this->acid]);
        }
    }

    /**
     * 修改自定义菜单
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {

            $model->scenario = 'update';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->success('修改成功！', Url::to(['wx-menu/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            //所属父级菜单
            $list = ZdhWxMenu::find()->where(['acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->asArray()->all();
            $menu_list[] = ['id' => 0, 'name' => '一级菜单'];
            foreach ($list as $item) {
                if ($item['pid'] == 0) {
                    $menu_list[] = ['id' => $item['id'], 'name' => '├ ' . $item['name']];
                    foreach ($list as $subitem) {
                        if ($subitem['pid'] = $item['id']) {
                            $n_list[] = ['id' => $subitem['id'], 'name' => '—├ ' . $subitem['name']];
                        }
                    }
                }
            }
            //所属素材
            $menu_click = ZdhWxMenuClick::find()->where(['acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->asArray()->all();
            return $this->render('edit', ['menu_list' => $menu_list, 'menu_click' => $menu_click, 'acid' => $this->acid, 'model' => $model]);
        }
    }

    /**
     * 删除自定义菜单
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDel($id)
    {
        $result = $this->findModel($id)->delete();
        $msg = $result ? $this->success('删除成功！', Url::to(['wx-menu/index'], true)) : $this->error('删除失败，请稍后再试！');
        return $msg;
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
        if (($model = ZdhWxMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 生成自定义菜单
     *
     */
    public function actionGenerateMenu()
    {
        if (!empty($this->acid)) {
            $model = ZdhWxAccounts::findOne($this->acid);
            $option = array(
                'token' => $model->token, //填写你设定的key
                'encodingaeskey' => $model->encodingaeskey, //填写加密用的EncodingAESKey
                'appid' => $model->app_id, //填写高级调用功能的app id
                'appsecret' => $model->app_secret, //填写高级调用功能的密钥
            );
            $wechat = new Wechat($option);

            $field = ['zdh_wx_menu.id', 'zdh_wx_menu.pid', 'zdh_wx_menu.click_id', 'name', 'zdh_wx_menu.type', 'type_content', 'zdh_wx_menu.sort'];
            $query = ZdhWxMenu::find();
            $data = $query->joinWith(['menuClick'])->select($field)->where(['zdh_wx_menu.acid' => $this->acid])->orderBy(['zdh_wx_menu.sort' => SORT_ASC])->limit(25)->offset(0)->asArray()->all(); //获取数据

            //数据level排序
            $n_data = [];
            foreach ($data as $k => $v) {
                if ($v['pid'] == 0) {
                    $n_data[$k] = $v;
                    foreach ($data as $subk => $subv) {
                        if ($subv['pid'] == $v['id']) {
                            $n_data[$k]['sub'][] = $subv;
                        }
                    }
                }
            }

            if (empty($n_data))
                return $this->error('请先添加菜单接点！');

            $menuArr = ['button' => []];
            foreach ($n_data as $item) {
                if (!empty($item['sub'])) {
                    $menu_items = [
                        'name' => $item['name'],
                        'sub_button' => '',
                    ];
                    foreach ($item['sub'] as $subItem) {
                        if ($subItem['type'] == 0) {
                            $menu_item = [
                                'type' => 'view',
                                'name' => $subItem['name'],
                                'url' => $subItem['type_content']
                            ];
                        }
                        if ($subItem['type'] == 1) {
                            $menu_item = [
                                'type' => 'click',
                                'name' => $subItem['name'],
                                'key' => $subItem['type_content']
                            ];
                        }
                        $menu_items['sub_button'][] = $menu_item;
                    }
                    $menuArr['button'][] = $menu_items;
                } else {
                    if ($item['type'] == 0) {
                        $menu_item = [
                            'type' => 'view',
                            'name' => $item['name'],
                            'url' => $item['type_content']
                        ];
                    }
                    if ($item['type'] == 1) {
                        $menu_item = [
                            'type' => 'click',
                            'name' => $item['name'],
                            'key' => $item['type_content']
                        ];
                    }
                    $menuArr['button'][] = $menu_item;
                }
            }

            $result = $wechat->createMenu($menuArr);
            $msg = $result ? $this->success('生成成功！', '', true) : $this->error('生成失败！');
            return $msg;
        } else {
            return $this->error('参数错误!');
        }
    }

}
