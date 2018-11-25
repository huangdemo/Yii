<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 嵌套列表</title>

    <meta name="keywords" content="">
    <meta name="description" content="">



</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
           <!--  <div class="col-sm-4">
                <div id="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-white btn-sm">展开所有</button>
                    <button type="button" data-action="collapse-all" class="btn btn-white btn-sm">收起所有</button>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>系统角色</h5>
                    </div>
                    <div class="ibox-content">

                     <!--    <p class="m-b-lg">
                            <strong>Nestable</strong> 支持拖动排序和触摸屏。
                        </p> -->

                        <div class="dd" id="nestable">
                            <!-- <ol class="dd-list">
                                
                            </ol> -->
                        </div>
                        <div class="m-t-md">
                            <h5>数据：</h5>
                        </div>
                        <textarea id="nestable-output" class="form-control"></textarea>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>用户角色</h5>
                    </div>
                    <div class="ibox-content">

                       <!--  <p class="m-b-lg">
                            每个列表可以自定义标准的CSS样式。每个单元响应所以你可以给它添加其他元素来改善功能列表。
                        </p>
 -->
                        <div class="dd" id="nestable2">
                    		<!-- <ol class="dd-list"> -->
                                <!-- <li class="dd-item" data-id="5">
                                    <div class="dd-handle">
                                        <span class="label label-warning"><i class="fa fa-users"></i></span> 用户
                                    </div>
                                </li> -->
                        	<!-- </ol> -->
                        </div>
                        <div class="m-t-md">
                            <h5>数据：</h5>
                        </div>
                        <textarea id="nestable2-output" class="form-control"></textarea>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4 col-sm-offset-2">
        	<button type="submit" id="submit" class="btn btn-primary">保存内容</button>
        </div>
    </div>

	   <?=Html::jsFile('@web/js/plugins/nestable/jquery.nestable.js')?>
    <script>

        $(document).ready(function () {

        	$.ajax({
	      				url: UrlArgent.CreateUrl('role/list.html'),
	      				type: 'GET',
	      				dataType: 'json',
	      				success:function(res){
	      					var lists =  res.data.lists;
  							var role_list = '';
	  					  	for (var i = 0; i < lists.length; i++) {
	  					  		role_list += '<li class="dd-item" data-id="'+lists[i].id+'"><div class="dd-handle">'+lists[i].name+'</div></li>';
	  					  	}	
	  					  	role_list = '<ol class="dd-list">'+role_list+'<ol>';
		                 	$('#nestable').append(role_list);
		                 	var list = res.data.list;
		                 	var role_user_list = '';
		                 	if(list.length == 0){
		                 		role_user_list = '<div class="dd-empty"></div>';
		                 	}else{
		                 		for (var i = 0; i < list.length; i++) {
		                 			role_user_list += '<li class="dd-item" data-id="'+list[i].id+'"><div class="dd-handle"><span class="label label-warning"><i class="fa fa-users"></i></span>'+list[i].name+'</div></li>';
			                 	}
	                 			role_user_list = '<ol class="dd-list" id="have_role_list">'+role_user_list+'<ol>';
		                 	}
		                 	
		                 	$('#nestable2').append(role_user_list);
	      				}
          			});

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('浏览器不支持');
                }
            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1,
                maxDepth:1
            }).on('change');

            // activate Nestable for list 2
            $('#nestable2').nestable({
                group: 1,
                maxDepth:1
            }).on('change', updateOutput);


            // output initial serialised data
            // updateOutput($('#nestable').data('output', $('#nestable-output')));
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));

            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });

        $('#submit').click(function(event) {
        	var nestable2 =  $('#nestable2').nestable('serialize');
        	var data = {};
        		data.id = JSON.stringify(nestable2);
        	    data.user_id = 50;
        	$.ajax({
        		url:  UrlArgent.CreateUrl('role/add-role.html'),
        		type: 'POST',
        		dataType: 'json',
        		data: data,
        		success:function(res){
        			console.log(res)
        		}
        	});
        	
        	
        });
    </script>

    
    
</body>

</html>
