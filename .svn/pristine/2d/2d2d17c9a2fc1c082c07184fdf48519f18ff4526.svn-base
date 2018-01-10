<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <div class="page-header">
        <h1>
            友情链接
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo Yii::$app->controller->action->id == 'add' ? '添加友情链接' : '修改友情链接' ?>
            </small>
        </h1>
    </div>
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a href="<?php echo Url::to(['demo/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                友情链接列表
                            </a>
                        </li>
                        <li class="active">
                            <a>
                                <i class="green icon-edit bigger-110"></i>
                                <?php echo Yii::$app->controller->action->id == 'add' ? '添加友情链接' : '修改友情链接' ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane in active">
                            <form id="ajaxForm" class="form-horizontal"
                                  action='<?php echo Yii::$app->controller->action->id == 'add' ? Url::to(['demo/add']) : Url::to(['demo/update', 'id' => $_GET['id']]) ?>'
                                  method="post">
                                <input type="hidden" name="DemoLik[id]"
                                       value="<?php echo isset($model['title']) ? $model['title'] : ''; ?>"/>

                                <div class="space-4"></div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label no-padding-right"> 标题 </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="DemoLink[title]" placeholder="请输入标题"
                                               class="col-xs-10 col-sm-5"
                                               value="<?php echo isset($model['title']) ? $model['title'] : ''; ?>"/>
                                        &nbsp;<span style="color:red">*</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label no-padding-right"> 排序编号 </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="DemoLink[sort]" placeholder="请输入 0 以上的数字进行排序"
                                               class="col-xs-10 col-sm-5"
                                               value="<?php echo isset($model['sort']) ? $model['sort'] : ''; ?>"/>
                                        &nbsp;<span style="color:red">*</span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label no-padding-right"> url链接地址 </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="DemoLink[url]" placeholder="请输入url链接地址"
                                               class="col-xs-10 col-sm-5"
                                               value="<?php echo isset($model['url']) ? $model['url'] : ''; ?>"/>
                                        &nbsp;<span style="color:red">*</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label no-padding-right"
                                    > 描述 </label>
                                    <div class="col-sm-10">
                                        <textarea class="col-xs-8" rows="5"
                                                  name="DemoLink[desc]"><?php echo isset($model['desc']) ? $model['desc'] : ''; ?></textarea>
                                        &nbsp;<span style="color:red">*</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label no-padding-right"> 状态</label>
                                    <div class="col-sm-2">
                                        <input type="radio" name="DemoLink[status]" class="ace"
                                            <?php if (isset($model) && $model['status'] == 1) echo "checked='checked'"; ?>
                                               value="1"/>
                                        <span class="lbl"> 已发布 </span>
                                        <input type="radio" name="DemoLink[status]" class="ace"
                                            <?php if (isset($model) && $model['status'] == 0) echo "checked='checked'"; ?>
                                               value="0"/>
                                        <span class="lbl"> 未审核 </span>
                                    </div>
                                </div>

                                <div class="space-4"></div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit">
                                            <i class="icon-ok bigger-110"></i>
                                            提交
                                        </button>

                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="button">
                                            <i class="icon-undo bigger-110"></i>
                                            <a style="color:white" href="<?php echo Url::to(['demo/index']) ?>">返回</a>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE CONTENT END -->
</div>
</div>
</div>


