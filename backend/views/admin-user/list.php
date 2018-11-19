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
        .container {
  /*background: #fdfdfd;*/
  padding: 1rem;
  margin: 3rem auto;
  border-radius: 0.2rem;
  counter-reset: pagination;
  text-align: center;
}
.container:after {
  clear: both;
  content: "";
  display: table;
}
.container ul {
  width: 100%;
}

.large {
  width: 45rem;
}


.pagination ul, li {
  list-style: none;
  display: inline;
  padding-left: 0px;
}

.pagination li {
  counter-increment: pagination;
}
.pagination li:hover a {
  color: #fdfdfd;
  background-color: #1d1f20;
  border: solid 1px #1d1f20;
}
.pagination li.active a {
  color: #fdfdfd;
  background-color: #1d1f20;
  border: solid 1px #1d1f20;
}

/*.pagination li:first-child a:after {
  content: "<";
}*/

.pagination li:nth-child(2) {
  counter-reset: pagination;
}

/*.pagination li:last-child a:after {
  content: ">";
}*/
.pagination li a {
  border: solid 1px #d6d6d6;
  border-radius: 0.2rem;
  color: #7d7d7d;
  text-decoration: none;
  text-transform: uppercase;
  display: inline-block;
  text-align: center;
  padding: 0.5rem 0.9rem;
}
/*.pagination li a:after {
  content: " " counter(pagination) " ";
}*/

/*.large li a {
  display: none;
}
.large li:first-child a {
  display: inline-block;
}
.large li:first-child a:after {
  content: "<";
}
.large li:nth-child(2) a {
  display: inline-block;
}
.large li:nth-child(3) a {
  display: inline-block;
}
.large li:nth-child(4) a {
  display: inline-block;
}
.large li:nth-child(5) a {
  display: inline-block;
}
.large li:nth-child(6) a {
  display: inline-block;
}
.large li:nth-child(7) a {
  display: inline-block;
}
.large li:nth-child(8) a {
  display: inline-block;
}
.large li:last-child a {
  display: inline-block;
}
.large li:last-child a:after {
  content: ">";
}
.large li:nth-last-child(2) a {
  display: inline-block;
}
.large li:nth-last-child(3) {
  display: inline-block;
}
.large li:nth-last-child(3):after {
  padding: 0 1rem;
  content: "...";
}*/

    </style>


</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row" id="user_list">

            <div class="col-sm-4"  v-for ="user in lists">
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
            <div class="container large">
            <div class="pagination" id="aso-pg-rank__pagination" v-cloak>
                 <div>共{{currentPage}}/{{totalPageCount}}页</div>
                     <ul class="aso-pagination" first-text="第一页" last-text="最后一页" max-size="50" next-text="下一页" previous-text="上一页">
                         <li class="pagination-first  ">
                             <a v-if="currentPage == 1" >第一页</a>
                             <a v-else href="javascript:;" @click="next(1)">第一页</a>
                         </li>
                         <li class="pagination-prev" v-if="currentPage>1"><a href="javascript:;" @click="next(currentPage-1)">上一页</a></li>
                         <li v-for="item in pagingList" class="pagination-page">
                             <a v-if="currentPage==item.key || sign ==item.key" class="activeye">{{item.key}}</a>
                             <a v-else href="javascript:;" @click="next(item.value)">{{item.key}}</a>
                         </li>
     
                         <li class="pagination-next" v-if="currentPage<totalPageCount"><a href="javascript:;" @click="next(currentPage+1)">下一页</a></li>
                         <li class="pagination-last">
                             <a v-if="totalPageCount == currentPage">尾页</a>
                             <a v-else href="javascript:;" @click="next(totalPageCount)">尾页</a>
                         </li>
                     </ul>
             </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
		



    <!-- 自定义js -->
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>

    <script src="https://cdn.bootcss.com/vue-resource/1.5.1/vue-resource.js"></script>

    <script>
       


    var pagitation=new Vue({
         el:'#user_list',
         data: {
             // 省略的符号
             sign:'...',
             // 省略号位置
             signIndex:5,
             // 总页数
             totalPageCount: 0,
             // 当前页
             currentPage:1,
             // 显示在页面的数组列表
             pagingList:[],
             lists:[] //数据
         },
         watch: {
             totalPageCount:function(val) {
                 var that = this
                 if (!val || val == '') return;
                 that.currentPage = 1;
                 that.init()
             },
             currentPage:function(val) {
                 var that = this
                 that.init()
             }
         },
         methods: {
             //获取订单数据
             getorder:function(){
                 this.$http.post(UrlArgent.CreateUrl('admin-user/list.html'),{
                     page:this.currentPage //传递请求页面
                 }, {
                     headers: {
                         "X-Requested-With": "XMLHttpRequest"
                     },
                     emulateJSON: true
                 }).then(function(res){
                   
                     this.lists=res.body.data.lists;           //获取数据
                     this.totalPageCount= res.body.data.totalPageCount;//获取总页数
                     console.log(this.totalPageCount)
                     json = res.body.data.lists;
                 })
             },
             // 初始化数据
             fetchData:function() {
                 var that = this
                 that.pagingList = [];
                 var tmp = null;
                 if ((that.totalPageCount) > 6) {
                     if (((that.totalPageCount-1) == (that.totalPageCount - that.currentPage)) && (that.totalPageCount - that.currentPage) > 5) {
                         for (var i=1;i<7;i++) {
                             if (i < that.signIndex) {
                                 tmp = {key:i, value:i }
                             } else if (i== that.signIndex) {
                                 tmp = {key:that.sign, value:0 }
                             } else if (i == (that.signIndex + 1) ) {
                                 tmp = {key:that.totalPageCount - 1, value:that.totalPageCount - 1 }
                             } else {
                                 tmp = {key:that.totalPageCount, value:that.totalPageCount }
                             }
                             that.pagingList.push(tmp)
                         }
                     } else if (((that.totalPageCount - that.currentPage) <= that.signIndex)){
                         var starNum = that.totalPageCount - 5;
                         for (var i=starNum;i<starNum+6;i++) {
                             tmp = {key:i, value:i }
                             that.pagingList.push(tmp)
                         }
                     } else {
                         var starNum = that.currentPage - 1;
                         for (var i=1;i<7;i++) {
                             if (i < that.signIndex) {
                                 tmp = {key:(starNum - 1) + i, value:(starNum - 1) + i }
                             } else if (i== that.signIndex) {
                                 tmp = {key:that.sign, value:0 }
                             } else if (i == (that.signIndex + 1) ) {
                                 tmp = {key:that.totalPageCount - 1, value:that.totalPageCount - 1 }
                             } else {
                                 tmp = {key:that.totalPageCount, value:that.totalPageCount }
                             }
                             that.pagingList.push(tmp)
                         }
                     }
                 } else {
                     for (var i =0; i <that.totalPageCount; i++) {
                         tmp = {key:i+1, value:i+1 }
                         that.pagingList.push(tmp)
                     }
                 }
             },
             // 跳转到某页码
             next:function(num) {
                 var that = this
                 if (num <= 1) that.currentPage = 1;
                 else if (num >= that.totalPageCount) that.currentPage = that.totalPageCount;
                 else that.currentPage = num;
                 //location.href="/asm/order?page"+that.currentPage;
             },
             init:function() {
                 var that = this
 
                 that.fetchData();
                 that.getorder();
             }
         },
         mounted:function() {
             var that = this
 
             that.init()
         }
     });



    </script>

    
    

</body>

</html>
