<?php
namespace apps_admin\controllers;

use app\models\DemoLink;
use common\controller\AdminController;
use Yii;
use yii\helpers\Url;

/**
 */
class DemoController extends AdminController
{
    /**
     * 友情链接列表页
     *
     * @return string
     */
    public function actionIndex()
    {
        $_SESSION['s_acid'] = 3;
        $_SESSION['wx_account']='dd';
        $_SESSION['username']='dds';
        $_SESSION['acid']=3;
        if (Yii::$app->request->isPost) {
            $model = new DemoLink();

            /* 初始化分页查询条件 */
            $pageSize = $this->post('iDisplayLength');    //每页记录数
            $maxRows = $model->find()->count();           //总记录数
            $page = $this->post('iDisplayStart');     //当前起始索引
            $field = ['id', 'title', 'url', 'desc', 'sort']; //查询字段
            $order = $this->post('iSortCol_0') != null ? $field[intval($this->post('iSortCol_0'))] . ' ' . $this->post('sSortDir_0') : 'sort desc';//排序
            $where = $this->post('title') != '' ? "title like '%" . $this->post('title') . "%'" : ''; //搜素标题title
            $displayRecords = $model->find()->where($where)->count();
            $data = $model->find()->select($field)->where($where)->orderBy($order)->limit($pageSize)->offset($page)->asArray()->all(); //获取数据

            /* 返回数据 */
            $list['iTotalRecords'] = $maxRows;   //总记录数
            $list['iTotalDisplayRecords'] = $displayRecords;   //过滤之后，实际的行数
            $list['aaData'] = $data;      //表中数据

            return $this->ajaxOutput($list);
        } else {
            return $this->render('index');
        }
    }

    /**
     * 添加友情链接
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $_SESSION['s_acid'] = 3;
        $_SESSION['wx_account']='dd';
        $_SESSION['username']='dds';
        $_SESSION['acid']=3;
        if (Yii::$app->request->isPost) {
            $model = new DemoLink();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->success('添加成功！', Url::to(['demo/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            return $this->render('edit');
        }
    }

    /**
     * 修改友情链接
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->success('修改成功！', Url::to(['demo/index'], true));
            } else {
                return $this->error(current($model->getFirstErrors()));
            }
        } else {
            return $this->render('edit', ['model' => $model,]);
        }
    }

    /**
     * 删除友情链接
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
        if (($model = DemoLink::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
