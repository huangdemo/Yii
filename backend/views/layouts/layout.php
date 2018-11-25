<?php 
use yii\helpers\Html;
use yii\helpers\Url;

?>
   
    <?=Html::cssFile('@web/favicon.ico')?>
    <?=Html::cssFile('@web/css/bootstrap.min.css?v=3.3.6')?>
    <?=Html::cssFile('@web/css/font-awesome.min.css?v=4.4.0')?>
    <?=Html::cssFile('@web/css/animate.css')?>
    <?=Html::cssFile('@web/css/style.css?v=4.1.0')?>
    
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
    <?=Html::jsFile('@web/js/content.js?v=1.0.0')?>

    
    
    <?=$content;?>



