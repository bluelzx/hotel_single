<?php
namespace apps_admin\controllers;

use app\models\WxMenu;
use app\models\ZdhWxMenu;
use app\models\ZdhWxMenuClick;
use common\controller\AdminController;
use Yii;
use yii\helpers\Url;

/**
 */
class WxMenuClickController extends AdminController
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
            $query = ZdhWxMenuClick::find();

            /* 初始化分页查询条件 */
            $pageSize = $this->post('iDisplayLength');    //每页记录数
            $maxRows = $query->where(['acid' => $this->acid])->count();           //总记录数
            $page = $this->post('iDisplayStart');     //当前起始索引
            $field = ['id', 'type', 'title', 'content', 'sort', 'created_at']; //查询字段
            $order = $this->post('iSortCol_0') != null ? $field[intval($this->post('iSortCol_0'))] . ' ' . $this->post('sSortDir_0') : 'sort desc';//排序
            $displayRecords = $query->where(['acid' => $this->acid])->count();
            $data = $query->select($field)->where(['acid' => $this->acid])->orderBy(['sort' => SORT_ASC])->limit($pageSize)->offset($page)->asArray()->all(); //获取数据

            /* 返回数据 */
            $list['iTotalRecords'] = $maxRows;   //总记录数
            $list['iTotalDisplayRecords'] = $displayRecords;   //过滤之后，实际的行数

            foreach ($data as $k => $v) {
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
                $data[$k] = $v;
            }
            $list['aaData'] = $data;      //表中数据

            return $this->ajaxOutput($list);
        } else {
            return $this->render('index');
        }
    }

    /**
     * 添加素材
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $model = new ZdhWxMenuClick();
            $type = $this->post('type');
            $data = [
                'acid' => $this->acid,
                'type' => $type,
                'title' => $this->post('title'),
                'sort' => $this->post('sort')
            ];
            if ($type == 1) {
                $content = $this->post('content');
                $data['content'] = $content;
            }
            if ($type == 2) {
                $content = $this->post('content_pic');
                $data['content'] = $content;
            }
            if ($type == 3) {
                $pic_content = [];
                $text_titles = $this->post('text_title');
                $text_urls = $this->post('text_url');
                foreach ($this->post('pic_url') as $k => $v) {
                    $pic_content[] = ['text_title' => $text_titles[$k], 'pic_url' => $v, 'text_url' => $text_urls[$k]];
                }
                $content = serialize($pic_content);
                $data['pic_content'] = $content;
            }
            $model->setAttributes($data, false);

            $model->scenario = 'add';
            if ($model->save()) {
                return $this->success('添加成功！', Url::to(['wx-menu-click/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            return $this->render('add', ['acid' => $this->acid]);
        }
    }

    /**
     * 修改素材
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $type = $this->post('type');
            $data = [
                'acid' => $this->acid,
                'type' => $type,
                'title' => $this->post('title'),
                'sort' => $this->post('sort')
            ];
            if ($type == 1) {
                $content = $this->post('content');
                $data['content'] = $content;
                $data['pic_content'] = '';
            }
            if ($type == 2) {
                $content = $this->post('content_pic');
                $data['content'] = $content;
                $data['pic_content'] = '';
            }
            if ($type == 3) {
                $pic_content = [];
                $text_titles = $this->post('text_title');
                $text_urls = $this->post('text_url');
                foreach ($this->post('pic_url') as $k => $v) {
                    $pic_content[] = ['text_title' => $text_titles[$k], 'pic_url' => $v, 'text_url' => $text_urls[$k]];
                }
                $content = serialize($pic_content);
                $data['pic_content'] = $content;
                $data['content'] = '';
            }
            $model->setAttributes($data, false);

            $model->scenario = 'update';
            if ($model->save()) {
                return $this->success('修改成功！', Url::to(['wx-menu-click/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * 删除素材
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDel($id)
    {
        $result = $this->findModel($id)->delete();
        $msg = $result ? $this->success('删除成功！', Url::to(['demo/index'], true)) : $this->error('删除失败，请稍后再试！');
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
        if (($model = ZdhWxMenuClick::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
