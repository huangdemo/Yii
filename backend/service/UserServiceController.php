<?php

namespace backend\service;
use backend\Service\CommonServiceController;
use app\models\AdminUser;
use common\helps\tools;
use  common\helps\CommonHelper;
use yii\data\Pagination;

class UserServiceController extends CommonServiceController {
    
    /**
     * 添加或者修改后台用户
     * @param type $post  数据
     * @param type $bool true 添加  false 修改
     * @return type 
     */
    public function AddUser($post,$bool=true)
    {
        $AdminUser = new AdminUser();
        if($bool){
            $AdminUser->load($post, ''); //批量插入
            if ($AdminUser->validate() && $AdminUser->save()) {
                return true;
            } else {
                 $error = tools::error($AdminUser->getFirstErrors());//失败返回错误
                return $error;
            }
        }else{
            
        }
    }
    
    /**
     * 查询用户信息
     * @param array $condition 
     * @param int $limit
     * @param int $page
     * @param string $order
     * @return array
     */
    public function UserList($condition=[],$limit=9,$page,$order="id desc")
    {
       
        $totalNumber = AdminUser::find()->count();
        $record = AdminUser::find()
                ->select('*')
                ->where($condition)
                ->offset(($page-1)*$limit)
                ->limit($limit)
                ->orderBy($order)
                ->all();
//        ->createCommand()->getRawSql();
//        echo $record;die;
        //对象转数组
        $data= array_map(function($record) {
                return $record->attributes;
        },$record);
        
        $result['totalNumber'] = $totalNumber;
        $result['lists'] =  $data;
        return $result;
    }
    
   
}
