<?php

namespace backend\controllers;

use Yii;
use backend\service\UserServiceController as User;
use common\helps\tools;
use app\models\UploadForm;
use common\helps\CommonHelper;
use common\models\UploadValidate;
use yii\web\UploadedFile;

class AdminUserController extends CommonController {

    public $layout = 'layout';   //定义父模板名为layout

    /**
     * 用户列表
     * @return type
     */

    public function actionList() {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $User = new User();
            $post = $request->post();
            $defaultPageSize = $post['page'];
            $condition = [];
            $resul = $User->UserList($condition,$defaultPageSize);
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
            if(isset($result['file'])){
                $result = tools::error($result['file']);
                 return tools::json('400', '图像上传失败',$result);
            }
            if ($result) {
                return tools::json('200', '图像上传成功',$result);
            }
        }
    }

}
