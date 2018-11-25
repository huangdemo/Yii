<?php

namespace backend\controllers;
use common\helps\tools;
use Yii;
use  backend\service\RoleServiceController as Role;

class RoleController extends \yii\web\Controller
{
    public $layout = 'layout';   //定义父模板名为layout
    
    /**
     * 角色列表页面
     * @return type
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * 授权页面
     * @return type
     */
     public function actionAccredit()
    {
        return $this->render('accredit');
    }
    
    /**
     * 查询要用户具有的角色
     * @return type
     */
    public function actionList()
    {
    	$request = Yii::$app->request;
    	$post = $request->get();
        $Role = new Role();
        $condition['status'] = 1;//角色是否正在使用 
        $condition['user_id'] = $post['id'];//用户id
        $result = $Role->RoleList($condition,true);
        return tools::json('200', '查询成功', $result);
    }
    
    /**
     * 用户授权角色
     * @return type
     */
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
