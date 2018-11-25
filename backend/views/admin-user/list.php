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
    <style type="text/css">
.page { 
  font-weight: 900; 
  height: 40px; 
  text-align: center; 
  color: #888; 
  margin: 20px auto 0; 
  background: #f2f2f2; 
} 
 
.pagelist { 
  font-size: 0; 
  background: #fff; 
  height: 50px; 
  line-height: 50px; 
} 
 
.pagelist span { 
  font-size: 14px; 
} 
 
.pagelist .jump { 
  border: 1px solid #ccc; 
  padding: 5px 8px; 
  -webkit-border-radius: 4px; 
  -moz-border-radius: 4px; 
  border-radius: 4px; 
  cursor: pointer; 
  margin-left: 5px; 
} 
 
.pagelist .bgprimary { 
  cursor: default; 
  color: #fff; 
  background: #337ab7; 
  border-color: #337ab7; 
} 
 
.jumpinp input { 
  width: 55px; 
  height: 26px; 
  font-size: 13px; 
  border: 1px solid #ccc; 
  -webkit-border-radius: 4px; 
  -moz-border-radius: 4px; 
  border-radius: 4px; 
  text-align: center; 
} 
 
.ellipsis { 
  padding: 0px 8px; 
} 
 
.jumppoint { 
  margin-left: 30px; 
} 
 
.pagelist .gobtn {} 
 
.bgprimary { 
  cursor: default; 
  color: #fff; 
  background: #337ab7; 
  border-color: #337ab7; 
}

    </style>


</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight" id="user_list">
        <div class="row">
            <div class="col-sm-4"  v-for ="user in lists">
                <div class="contact-box">
                    <a href="#"  @click = "details(user.id)">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive" :src="user.portrait">
                                <div class="m-t-xs font-bold">CTO</div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3><strong>{{user.name}}</strong></h3>
                            <p><i class="fa fa-map-marker"></i> {{user.phone}}</p>
                            <address :title="user.explain" style="width: 160px; height: 20px; overflow: hidden; display: block; text-overflow: ellipsis; white-space: nowrap; cursor: pointer;">
                            {{user.explain}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="page"  v-show="show"> 
            <div class="pagelist">
                <span class="jump">共{{totalNumber}}条</span> 
                <span class="jump"v-show="current_page>1" @click="jumpPage(current_page-1)">上一页</span> 
                <span v-show="current_page>5" class="jump" @click="jumpPage(1)">1</span> 
                <span class="ellipsis"  v-show="efont">...</span> 
                <span class="jump" v-for="num in indexs" :class="{bgprimary:current_page==num}" @click="jumpPage(num)">{{num}}</span> 
                <span class="ellipsis"  v-show="efont&&current_page<pages-4">...</span> 
                <span class="jump" @click="jumpPage(current_page+1)">下一页</span> 
                <span v-show="current_page<pages-1" class="jump" class="jump" @click="jumpPage(pages)">{{pages}}</span> 
                <span class="jumppoint">跳转到：</span> 
                <span class="jumpinp"><input type="text" v-model="changePage"></span> 
                <span class="jump gobtn" @click="jumpPage(changePage)">GO</span> 
            </div> 
        </div> 
    </div>

    <!-- 全局js -->
		



    <!-- 自定义js -->
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>


    <script>
       


    var app =new Vue({
         el:'#user_list',
         data: {
            current_page: 1, //当前页 
            pages: 0, //总页数 
            changePage:'',//跳转页 
            totalNumber:100,//多少条数据
            limit:9,//多少条分页
            order:'desc',//排序
            orderField:'id',//以id排序
            lists:[]
         },
        computed:{ 
                 show:function(){ 
                     return this.pages && this.pages !=1 
                 }, 
                 efont: function() { 
                   if (this.pages <= 7) return false; 
                   return this.current_page > 5 
                 }, 
                 indexs: function() { 
             
                   var left = 1, 
                     right = this.pages, 
                     ar = []; 
                   if (this.pages >= 7) { 
                     if (this.current_page > 5 && this.current_page < this.pages - 4) { 
                       left = Number(this.current_page) - 3; 
                       right = Number(this.current_page) + 3; 
                     } else { 
                       if (this.current_page <= 5) { 
                         left = 1; 
                         right = 7; 
                       } else { 
                         right = this.pages; 
             
                         left = this.pages - 6; 
                       } 
                     } 
                   } 
                   while (left <= right) { 
                     ar.push(left); 
                     left++; 
                   } 
                   return ar; 
                 }, 
               }, 
         methods: {
            jumpPage: function(id) { 
                this.current_page = parseInt(id);
                var data = {};
                data.page = this.current_page;
                data.limit = this.limit;//多少条分页
                data.order = this.order;//排序
                data.orderField = this.orderField;//以id排序
              $.ajax({
                   url: UrlArgent.CreateUrl('admin-user/list.html'),
                   type: 'POST',
                   dataType: 'json',
                   data: data,
               })
               .done(function(res) {
                    var list = res.data.lists;
                    for (var i = 0; i < list.length; i++) {
                        if( list[i].portrait == null || list[i].portrait == ''){
                            list[i].portrait = UrlArgent.CreateUrl('img/a3.jpg');
                        }else{
                            list[i].portrait = UrlArgent.CreateUrl(list[i].portrait);
                        }
                    }
                    app.lists= list; //获取数据
                    app.totalNumber = res.data.totalNumber;
                    app.pages= Math.ceil(res.data.totalNumber/app.limit);//获取总页数
               })
               .fail(function() {
                   console.log("error");
               })
               .always(function() {
                   console.log("complete");
               });
                
            }, 
            details: function(id){
                window.location.href= UrlArgent.CreateUrl('admin-user/add.html',{'id':id,'type':2});
                console.log(id)
            },
         },
         mounted:function() {
             var that = this;
             that.jumpPage(1);
         }
         
     });



    </script>

    
    

</body>

</html>
