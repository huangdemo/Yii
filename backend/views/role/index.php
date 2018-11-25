<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 数据表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

 	<?=Html::cssFile('@web/js/plugins/fancybox/jquery.fancybox.css')?>
 	

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本 <small>分类，查找</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_data_tables.html#">选项1</a>
                                </li>
                                <li><a href="table_data_tables.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <table id="editable" width="100%" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                            	 	<th><input type="checkbox" name="checkbox"/></th>
                                    <th >ID</th>
                                    <th>账号</th>
                                    <th>用户名</th>
                                    <th>手机号</th>
                                    <th width="7%">性别</th>
                                    <th>出生日期</th>
                                    <th>说明</th>
                                    <th>图像</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
               				
                             
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   	<?=Html::jsFile('@web/js/plugins/jeditable/jquery.jeditable.js')?>
    <?=Html::jsFile('@web/js/plugins/dataTables/jquery.dataTables.js')?>
    <?=Html::jsFile('@web/js/plugins/dataTables/dataTables.bootstrap.js')?>
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>
    <?=Html::jsFile('@web/js/plugins/fancybox/jquery.fancybox.js')?>


    <!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {

            //渲染列表  页面初始化时
    	var t = $("#editable").DataTable({
            "processing": true,
            "searching": false,//关闭搜索框
            "serverSide": true,//服务器分页
            "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 2,3,4,5,6,7,8,9 ] }],
           	"aaSorting": [[ 1, "asc" ]],
         	"bDeferRender": true, //是否启用延迟加载：当你使用AJAX数据源时，可以提升速度。默认值：False
            "ajax": function(d,callback,settings){
                var param = {};//因为服务端排序，可以新建一个参数对象

                param.order = d.order[0]['dir'];// 排序
                param.orderField = 'id';// 以哪个字段排序
                // param.start = d.start;//开始的序号
                param.draw = d.draw;
                param.page =  d.start/d.length+1;//开始的序号
                param.limit = d.length;//要取的数据的条数
                $.ajax({
                	url: UrlArgent.CreateUrl('admin-user/list.html'),
                	type: 'POST',
                	dataType: 'json',
                	data: param,
                	success:function(res){
	                	if(res.code != '200'){
	                		return;
	                	}
	                	//封装返回数据
						var returnData = {};
						returnData.draw = res.data.draw;//这里直接自行返回了draw计数器,应该由后台返回
						returnData.recordsTotal = res.data.totalNumber;//返回数据全部记录
						returnData.recordsFiltered = res.data.totalNumber;//后台不实现过滤功能，每次查询均视作全部结果
						returnData.data = res.data.lists;//返回的数据列表
						//调用DataTables提供的callback方法，代表数据已封装完成并传回DataTables进行渲染
						//此时的数据需确保正确无误，异常判断应在执行此回调前自行处理完毕
						callback(returnData);
					}
                })
               
                
               

            }, "createdRow": function (row, data, index) {
        		
                /* 设置表格中的内容居中 */
                $('td', row).attr("class", "text-center");
            },
            //定义列: 取相应属性字段
            "columns": [
	             {
	                'data': "id",
	                'render': function (data, type, row) {
	                    return '<input type="checkbox" name="subcheckbox" value="' + data + '"/>';
	                },
	                'bSortable': false
	            },
                { "name":"id","data": "id" },
                { "name":"name","data": "name" },
                { "name":"user","data": "user" },
                { "name":"phone","data": "phone" },
             	{
	                'name': 'age',
	                'data': 'age',
	                'render': function (data, type, row) {
	                	if(data == 1){
	                		data = '男';
	                	}else if(data == 0){
	                		data = '女';
	                	}
	                    return data;
                	}
            	},
                { "name":"birth","data": "birth" },
                { "name":"explain","data": "explain" },
                {
	                'name': 'portrait',
	                'data': 'portrait',
	                'render': function (data, type, row) {
	                	if(data == ""){
                			data = '<a class="fancybox" href='+UrlArgent.CreateUrl('img/a3.jpg')+' title='+row.name+'><img alt="image" src='+UrlArgent.CreateUrl('img/a3.jpg')+' /></a>'
     					
	                	}else{
	                		data = '<a class="fancybox" href='+UrlArgent.CreateUrl(data)+' title='+row.name+'><img alt="image" src='+UrlArgent.CreateUrl(data)+' /></a>'
	                	}
	                    return data;
                	}
            	},
        	 	{
	                'name': 'id',
	                'render': function (data, type, row) {
	                	var id = '"' + row.id + '"';
						html = '<div class="btn-group"><button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" aria-expanded="false">操作 <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="javascript:;" onclick=accredit('+id+')>授权</a></li><li><a href="buttons.html#">禁用</a></li><li class="divider"></li><li><a href="buttons.html#">删除</a> </li></ul></div>';
						return html;

                	}
            	},

            ],
            "language": {
                "lengthMenu": "每页 _MENU_ 条记录",
                "zeroRecords": " ",
                "info": "当前 _START_ 条到 _END_ 条 共 _TOTAL_ 条",
                "sInfo" : "第 _PAGE_ 页 ( 总共 _PAGES_ 页，_TOTAL_ 条记录 )",
                "infoEmpty": "无记录",
                "infoFiltered": "(从 _MAX_ 条记录过滤)",
                "search": "用户",
                "processing": "载入中",
                "paginate": {
                    "first": "首页",
                    "previous": "上一页",
                    "next": "下一页",
                    "last": "尾页"
                },
                "oAria": {
	                "sSortAscending": ": 以升序排列此列",
	                "sSortDescending": ": 以降序排列此列"
            	}
            },
            "aLengthMenu": [
                [10, 25, 50, 100], [10, 25, 50, 100]
            ],
            "paging": true,//分页
            "pagingType": "full_numbers",//显示首页尾页
            "sPaginationType": "full_numbers",  
            // "ordering": true,//排序
            "info": true,//信息
            "paging": true,
            initComplete: function (settings, data) {
              
            },
            "drawCallback": function (settings, data) {

            }

        })
    });
	
   	$(document).ready(function () {
        $('.fancybox').fancybox({
            openEffect: 'none',
            closeEffect: 'none'
        });
    });

   	function accredit(id){
   		var url = UrlArgent.CreateUrl('role/accredit.html',{'id':id});
   		//iframe窗
		//iframe层
		parent.layer.open({
		    type: 2,
		    title: '用户授权',
		    shadeClose: true,
		    shade: 0.8,
		    area: ['980px', '90%'],
		    content: url,
	     	end: function(){ //此处用于演示
		       alert('关闭')
    		}

		});
   	}
   	

    </script>

    
    

</body>

</html>
