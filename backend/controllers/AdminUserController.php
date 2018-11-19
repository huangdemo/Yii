<?php

namespace backend\controllers;

use Yii;
use backend\service\UserServiceController as User;
use common\helps\tools;
use common\helps\CommonHelper;
use common\models\UploadValidate;

class AdminUserController extends CommonController {

    public $layout = 'layout';   //定义父模板名为layout

    /**
     * 用户列表
     * @param int   page 当前页码
     * @param int   limit 一页多少条
     * @param string order 排序规则
     * @param string orderField 以哪个字段排序
     * @param  array condition 条件
     * @return json
     */

    public function actionList() {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $User = new User();
            $page = $request->post('page', 0); //当前页码
            $limit = $request->post('limit', 9); //一页多少条
            $order = $request->post('order', 'asc'); //排序
            $orderField = $request->post('orderField', 'id'); //以哪个字段排序
            $condition = []; //搜索条件 
            $resul = $User->UserList($condition, $limit, $page, $orderField . ' ' . $order);
            return tools::json('200', '查询成功', $resul);
        } else {
            return $this->render('list');
        }
    }

    /**
     * 添加用户
     * @return type
     */
    public function actionAdd() {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $User = new User();
            $post = $request->post();
            $post['add_time'] = date('Y-m-d');
            $result = $User->AddUser($post, true);
            if ($result === true) {
                return tools::json('200', '添加成功');
            } else {
                return tools::json('500', $result);
            }
        } else {
            return $this->render('add');
        }
    }

    /**
     * 上传图像
     * @return type
     */
    public function actionPortrait() {
        if (Yii::$app->request->isPost) {
//          实例化上传验证类，传入上传配置参数项名称
            $model = new UploadValidate('test_upload');
            //上传
            $result = CommonHelper::myUpload($model, 'portrait', 'uploads');
            if (isset($result['file'])) {
                $result = tools::error($result['file']);
                return tools::json('400', '图像上传失败', $result);
            }
            if ($result) {
                return tools::json('200', '图像上传成功', $result);
            }
        }
    }

}
