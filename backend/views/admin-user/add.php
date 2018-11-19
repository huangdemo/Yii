<!-- <?php
use yii\helpers\Html;
use yii\helpers\Url;
?> -->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基本表单</title>
    <meta name="keywords" content="">
    <meta name="description" content="">


</head>

<body class="gray-bg">
    <div  id="add_user">
        <form  class="form-horizontal" @submit.prevent="submit" style="margin-left: 10px;">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>添加后台管理人 <small>包括自定义样式的复选和单选按钮</small></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="form_basic.html#">选项1</a>
                                        </li>
                                        <li><a href="form_basic.html#">选项2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="ibox-content">
                                
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">账号</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="user" v-model="user.user" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">用户名</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" v-model="user.name" class="form-control"> <span class="help-block m-b-none">帮助文本，可能会超过一行，以块级元素显示</span>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">密码</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="password" v-model="user.password">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">手机号</label>

                                        <div class="col-sm-10">
                                            <input type="text" placeholder="手机号" name="phone" v-model="user.phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    
                                   
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">性别
                                        </label>

                                        <div class="col-sm-10">
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="radio" checked="" value="1" name="age" v-model="user.age" id="optionsRadios1" >男</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="radio" value="0"  name="age" v-model="user.age" id="optionsRadios2" >女</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">出生日期：</label>
                                        <div class="col-sm-10">
                                            <input class="form-control layer-date" name="birth" v-model="user.birth" value="1995-12-12" placeholder="YYYY-MM-DD" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                            <label class="laydate-icon"></label>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group" >
                                            <div class="icol-sm-10" style="width: 50%;margin-left: 25%;">
                                                <div class="ibox-title">
                                                    <h5>添加图像 <small>点击上传</small></h5>
                                                    <div class="ibox-tools">
                                                        <a class="collapse-link">
                                                            <i class="fa fa-chevron-up"></i>
                                                        </a>
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#" aria-expanded="false">
                                                            <i class="fa fa-wrench"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li><a href="form_basic.html#">选项1</a>
                                                            </li>
                                                            <li><a href="form_basic.html#">选项2</a>
                                                            </li>
                                                        </ul>
                                                        <a class="close-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="text-center">
                                                        <a data-toggle="modal" class="btn btn-primary" href="form_basic.html#modal-form">点击上传窗口</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">说明：</label>
                                        <div class="col-sm-8">
                                            <textarea id="ccomment" name="explain" v-model="user.explain" class="form-control" required="" aria-required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit" >保存内容</button>
                                            <button class="btn btn-white" type="submit">取消</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <button class="btn btn-danger  dim btn-large-dim" style="margin-left: 27%;margin-top: 18%;" type="button">
                                       <input type="file" style="opacity:0;width:100%;height:100%;position:absolute;top:0;left:0" type="file" name="portrait" @change="fileUpload();">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <h4>用户头像</h4>
                                    <p></p>
                                    <p class="text-center">
                                        <i  id="portrait"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
   <!--  <form id="uploadForm" enctype="multipart/form-data">
    
    </form> -->
    </div>

    <!-- 全局js -->

    <!-- 自定义js -->
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>
    <?=Html::jsFile('@web/js/plugins/layer/laydate/laydate.js')?>

    <!-- iCheck -->
    <?=Html::jsFile('@web/js/plugins/iCheck/icheck.min.js')?>
    <script type="text/javascript">

    var App = new Vue({
        el: '#add_user',
        inject: 'reload', // 引入方法
        data: {
            user: {
                name: 'name',
                user: 'user',
                password :'password',
                phone:'phone',
                age:'1',
                birth:'2014-11-11',
                explain:'说明',
                portrait:''
            }
        },
        methods: {
            submit: function() {

              // var formData = JSON.stringify(this.user); // 这里才是你的表单数据
              $.ajax({ 
                  // url: "<?=Url::to(['admin-user/add'],true)?>",
                  url: UrlArgent.CreateUrl('admin-user/add.html'),
                  type: 'POST',
                  dataType: 'json',
                  data: this.user// 这里才是你的表单数据

              })
              .done(function(data) {
                    if(data.code == '200'){
                       location.reload()
                    }else{

                    }
                     parent.layer.msg(data.msg);
              })
              .fail(function() {
                  console.log("error");
              });
             
            },
            fileUpload: function(){
                   
                    var formData = new FormData() // 声明一个FormData对象
                    var formData = new window.FormData() // vue 中使用 window.FormData(),否则会报 'FormData isn't definded'
                    formData.append('portrait', document.querySelector('input[type=file]').files[0]) // 'portrait' 这个名字要和后台获取文件的名字一样;
                    var postList = null;
                    $.ajax({
                        // url: "<?=Url::to(['admin-user/portrait'],true)?>",
                        url: UrlArgent.CreateUrl('admin-user/portrait.html'),
                        type: 'POST',
                        async: false,
                        dataType: 'json',
                        data: formData,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {
                        if(res.code == '200'){
                            App.user.portrait = res.data.file_path;
                            //添加图像
                            var html = "<img width=200 height=200 src="+UrlArgent.CreateUrl(res.data.file_path)+" />";
                            $('#portrait').html(html);
                            parent.layer.msg(res.msg);
                        }else{
                            parent.layer.msg(res.data);
                        }
                    });
                    
                    
            }
            
        }

    })




    </script>
       

    
    

</body>

</html>
