<?php
use yii\helpers\Url;

?>
<form id="ajaxForm" class="form-horizontal" method="post"
      action="<?php echo Yii::$app->controller->action->id == 'add' ? Url::to(['wx-menu/add']) : Url::to(['wx-menu/update', 'id' => $model['id']]); ?>"
      enctype="multipart/form-data">

    <input type="hidden" name="ZdhWxMenu[id]"
           value="<?php echo isset($model['id']) ? $model['id'] : ''; ?>"/>
    <input type="hidden" name="ZdhWxMenu[acid]"
           value="<?php echo !empty($acid) ? $acid : ''; ?>"/>

    <div class="page-content" style="margin-top:-20px">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a href="<?php echo Url::to(['wx-menu/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                自定义菜单列表
                            </a>
                        </li>

                        <li class="active">
                            <a href="#">
                                <i class="green icon-edit bigger-110"></i>
                                <?php echo Yii::$app->controller->action->id == 'add' ? '添加自定义菜单' : '修改自定义菜单' ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="hotel_level"
                                                           class="col-sm-2 control-label">所属父级菜单</label>
                                                    <div class="col-sm-10"><select class="control-label col-sm-12"
                                                                                   id="room_type" name="ZdhWxMenu[pid]">
                                                            <?php foreach ($menu_list as $item): ?>
                                                                <option
                                                                    value="<?php echo $item['id'] ?>" <?php if (isset($model['pid']) && $model['pid'] == $item['id']) echo 'selected' ?>><?php echo $item['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">名称</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                               name="ZdhWxMenu[name]" autocomplete="off"
                                                               value="<?php echo isset($model['name']) ? $model['name'] : ''; ?>">
                                                        <span id="tips" style="color: red"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="integral"
                                                           class="col-sm-2 control-label">菜单类型</label>
                                                    <div class="col-sm-10">
                                                        <select class="control-label col-sm-12" id="seltype"
                                                                name="ZdhWxMenu[type]">
                                                            <option
                                                                value="-1">
                                                                无类型
                                                            </option>
                                                            <option
                                                                value="0" <?php if (isset($model['type']) && $model['type'] == 0) echo 'selected' ?>>
                                                                链接
                                                            </option>
                                                            <option
                                                                value="1" <?php if (isset($model['type']) && $model['type'] == 1) echo 'selected' ?>>
                                                                事件
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hotel_phone"
                                                           class="col-sm-2 control-label">URL或事件</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                               name="ZdhWxMenu[type_content]"
                                                               value="<?php echo isset($model['type_content']) ? $model['type_content'] : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">排列序号</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                               name="ZdhWxMenu[sort]"
                                                               value="<?php echo isset($model['sort']) ? $model['sort'] : 0; ?>">
                                                    </div>
                                                </div>
                                                <?php if (empty($model['click_id'])): ?>
                                                    <div class="form-group" id="div_menu_click" style="display: none">
                                                        <label for="integral"
                                                               class="col-sm-2 control-label">所属素材</label>
                                                        <div class="col-sm-10">
                                                            <select class="control-label col-sm-12"
                                                                    name="ZdhWxMenu[click_id]">
                                                                <?php foreach ($menu_click as $item): ?>
                                                                    <option
                                                                        value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form-group" id="div_menu_click">
                                                        <label for="integral"
                                                               class="col-sm-2 control-label">所属素材</label>
                                                        <div class="col-sm-10">
                                                            <select class="control-label col-sm-12"
                                                                    name="ZdhWxMenu[click_id]">
                                                                <?php foreach ($menu_click as $item): ?>
                                                                    <option
                                                                        value="<?php echo $item['id'] ?>" <?php if (isset($model['click_id']) && $model['click_id'] == $item['id']) echo 'selected' ?>><?php echo $item['title'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-success big" type="submit" id="submit">
                                                            保存
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-danger big" type="button"
                                                                onclick="javascript:history.go(-1)">
                                                            返回
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div></div>
</form>


<script type="text/javascript">
    seajs.use(['$'], function ($, sel) {
        $("#seltype").on('change', function () {
            if ($(this).val() == "1") {
                $('#div_menu_click').show();
            } else {
                $('#div_menu_click').hide();
            }
        })
    });
</script>
