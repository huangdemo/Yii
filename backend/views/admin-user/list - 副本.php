<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 用户列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">



</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row" id="user_list">

            <div class="col-sm-4"  v-for ="user in users">
                <div class="contact-box">
                    <a href="profile.html">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo Url::to('@web/img/a3.jpg'); ?>">
                                <div class="m-t-xs font-bold">CTO</div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3><strong>{{user.name}}</strong></h3>
                            <p><i class="fa fa-map-marker"></i> {{user.phone}}</p>
                            <address>
                            {{user.explain}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
            </div>
    
        </div>
    </div>

    <!-- 全局js -->
		



    <!-- 自定义js -->
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>



    <script>
        $(document).ready(function () {
            $('.contact-box').each(function () {
                animationHover(this, 'pulse');
            });
        });


         //vue的生命周期
    
  var vmm=new Vue({
    el: "#user_list",
    data: {
        users: [],
        title:'用户列表'
 
    },
    mounted:function(){
        this.showData();
        //需要执行的方法可以在mounted中进行触发，其获取的数据可以赋到data中后，可以放在前面进行渲染
    },
    methods:{
        showData:function () {
            jQuery.ajax({
                type: 'post',
                url: UrlArgent.CreateUrl('admin-user/list.html'),
                dataType: 'json',
                success: function (res) {
                    for(var i=0;i<res.data.length;i++){
                        vmm.users.push(res.data[i]);
                    }
               }
           });
        }
    }
    });



    </script>

    
    

</body>

</html>
