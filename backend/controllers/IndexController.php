<?php

namespace backend\controllers;

class IndexController extends CommonController
{
	public $layout = 'layout';   //定义父模板名为layout

    public function actionIndex()
    {
    	//会自动加载父模板 
        return $this->render('index');
        // //不会自动加载父模板
        // return $this->renderpartial('index');
    }

    public function actionStats()
    {
    	//会自动加载父模板 
        return $this->render('stats');
       
    }

}
