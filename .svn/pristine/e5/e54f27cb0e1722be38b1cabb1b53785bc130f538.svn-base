<html lang="zh-CN" style="height:100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>API接口管理工具</title>
    <link href="<?php echo yii::$app->request->baseUrl ?>/js/libs/bootstrap-3.3.4-dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body style="height:100%" class="beautify">
<div class="container-fluid" style="background:white;height:100%;">
    <div class="row" style="height:100%;">
        <div id="mainwindow" class="col-md-12"
             style="height:100%;background:white;margin:0px;overflow-y:auto;padding:0px;">
            <!--主窗口start-->
            <div style="padding:16px;">
                <!--接口详情列表与接口管理start-->
                <script>
                    function test() {
                        $("#editor").empty();
                        var url = $("input[name='url']").val();
                        if (url == '') {
                            alert('URL 不能为空');
                            return;
                        }
                        //var apiUrl = 'http://hotelsingle.api.szgrows.com/index.php' + url;
                        var apiUrl = 'http://localhost2/hotelsingle/apps_manage/web/index.php' + url;
                        var type = $("select[name='type']").val();
                        var param = {};
                        $("#parameter tr").each(function () {
                            var name = $(this).find("input[name='p[name][]']").val();
                            var defa = $(this).find("input[name='p[default][]']").val();
                            /*if (name == '') {
                             alert("必填参数不能为空");
                             return false;

                             }*/
                            if (name != '' && defa != '') {
                                param[name] = defa;
                            }

                        });

                        if (type == "GET") {
                            $.get(apiUrl, param, function (data) {

                                $("#editor").text(JSON.stringify(data));
                            });
                        } else {
                            $.post(apiUrl, JSON.stringify(param), function (data) {

                                $("#editor").text(JSON.stringify(data));
                            });
                        }

                        return false;
                    }
                </script>
                <!--添加接口 start-->
                <div style="border:1px solid #ddd">
                    <div style="background:#f5f5f5;padding:20px;position:relative">
                        <div style="margin-left:20px;">
                            <h5>请求地址：</h5>
                            <div class="form-group has-error">
                                <div class="input-group">
                                    <div class="input-group-addon">url</div>
                                    <input type="text" class="form-control" name="url" placeholder="请求地址"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group" required="required">
                                <select class="form-control" name="type">
                                    <option value="POST">POST</option>
                                    <option value="GET">GET</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <h5>请求参数：</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="col-md-5">参数名</th>
                                        <th class="col-md-5">参数值</th>
                                        <th class="col-md-2">
                                            <button type="button" class="btn btn-success" onclick="add()">新增
                                            </button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="parameter">
                                    <tr>
                                        <td class="form-group has-error">
                                            <input type="text" class="form-control" name="p[name][]"
                                                   placeholder="参数名">
                                        </td>
                                        <td><input type="text" class="form-control" name="p[default][]"
                                                   placeholder="缺省值"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="del(this)">删除
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <h5>返回结果：</h5>
                                    <textarea name="re" rows="13" class="form-control " id="editor"
                                              placeholder="返回结果"></textarea>
                            </div>
                            <button class="btn btn-success " onclick="test()">测试</button>
                        </div>
                    </div>
                </div>
                <script>
                    function add() {
                        var $html = '<tr>' +
                            '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required"></td>' +
                            '<td>' +
                            '<input type="text" class="form-control" name="p[default][]" placeholder="缺省值">' +
                            '</td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' +
                            '</td>' +
                            '</tr >';
                        $('#parameter').append($html);
                    }
                    function del(obj) {
                        $(obj).parents('tr').remove();
                    }
                </script>
                <!--添加接口 end-->

                <!--接口详情列表与接口管理end-->            </div>
            <!--主窗口end-->
        </div>
    </div>
</div>
<script src="<?php echo yii::$app->request->baseUrl ?>/js/libs/jquery/jquery-1.11.3.js"></script>
<script src="<?php echo yii::$app->request->baseUrl ?>/js/libs/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>