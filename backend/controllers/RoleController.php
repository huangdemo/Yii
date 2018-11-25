<?php

namespace backend\controllers;
use common\helps\tools;
use Yii;
use  backend\service\RoleServiceController as Role;

class RoleController extends \yii\web\Controller
{
    public $layout = 'layout';   //定义父模板名为layout

    public function actionIndex()
    {
        return $this->render('index');
    }

     public function actionAccredit()
    {
        return $this->render('accredit');
    }
    
    
    public function actionList()
    {
        $Role = new Role();
        $condition['status'] = 1; 
        $condition['user_id'] = 50;//用户id
        $result = $Role->RoleList($condition,true);
        return tools::json('200', '查询成功', $result);
    }

    public function actionAddRole()
    {
    	$request = Yii::$app->request;
    	$post = $request->post();
        $id = $post['id'];
        $user_id = $post['user_id'];
    	var_dump(json_decode($id,true));die;
    	$Role = new Role();

    }

}
