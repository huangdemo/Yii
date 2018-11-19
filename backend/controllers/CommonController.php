<?php

namespace backend\controllers;

class CommonController extends \yii\web\Controller {

    /**
     * 返回json数据
     * @param type $code 状态码
     * @param type $message 提示语
     * @param type $data    数据
     */
    public function ajaxReturn($code, $message = '', $data = []) {
        if (empty($data)) {
            $result = [
                'code' => $code,
                'msg' => $message
            ];
        } else {
            $result = [
                'code' => $code,
                'msg' => $message,
                'data' => $data
            ];
        }

        return \yii\helpers\Json::encode($result);
    }

}
