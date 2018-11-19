<?php

namespace common\helps;

/*
 * 自定义全局公共方法
 */

class tools {

    /**
     * 返回json数据
     * @param type $code 状态码
     * @param type $message 提示语
     * @param type $data    数据
     */
    public static function json($code, $message = '', $data = []) {
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
    
    /**
     * 接受post参数
     * @return array
     */
    public static function post()
    {
        $post = file_get_contents("php://input");
        $post = json_decode($post, true);
        return $post;
    }
    
    /**
     * 表单错误处理
     * @param array $error  错误消息
     * @return string
     */
    public static function error($error)
    {
        $data = "";
        foreach ($error as $key => $val) {
            $data .= $val.'<br>';
        }
        return $data;
    }


}

?>