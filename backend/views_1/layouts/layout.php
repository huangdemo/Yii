<?php 
use yii\helpers\Html;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title> hAdmin- 主页</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- <link rel="shortcut icon" href="favicon.ico"> -->
    <?=Html::cssFile('@web/favicon.ico')?>
    <?=Html::cssFile('@web/css/bootstrap.min.css?v=3.3.6')?>
    <?=Html::cssFile('@web/css/font-awesome.min.css?v=4.4.0')?>
    <?=Html::cssFile('@web/css/animate.css')?>
    <?=Html::cssFile('@web/css/style.css?v=4.1.0')?>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <?php echo  $this->render('menu')?>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <?=$content;?>
        <!--右侧部分结束-->
    </div>
  
    <!-- 全局js -->
    <?=Html::jsFile('@web/js/jquery.min.js?v=2.1.4')?>
    <?=Html::jsFile('@web/js/bootstrap.min.js?v=3.3.6')?>
    <?=Html::jsFile('@web/js/plugins/metisMenu/jquery.metisMenu.js')?>
    <?=Html::jsFile('@web/js/plugins/slimscroll/jquery.slimscroll.min.js')?>
    <?=Html::jsFile('@web/js/plugins/layer/layer.min.js')?>
    <?=Html::jsFile('@web/js/vue.min.js')?>
   

    <!-- 自定义js -->
    <?=Html::jsFile('@web/js/hAdmin.js?v=4.1.0')?>
    <?=Html::jsFile('@web/js/index.js')?>
    <?=Html::jsFile('@web/js/common/UrlArgent.js')?>
    <!-- 第三方插件 -->
    <?=Html::jsFile('@web/js/plugins/pace/pace.min.js')?>

</body>

</html>
