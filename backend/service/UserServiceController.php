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
    
    public function UserList($condition=[],$defaultPageSize,$limit=9,$order="id desc")
    {
        $defaultPageSize = $defaultPageSize-1+9*($defaultPageSize-1);
        if($defaultPageSize <= 0){
            $defaultPageSize =1;
        }
        $totalPageCount = AdminUser::find()->count();
        $record = AdminUser::find()
                ->select('*')
                ->where($condition)
                ->offset($defaultPageSize)
                ->limit($limit)
                ->orderBy($order)
                ->all();
//                ->createCommand()->getRawSql();
//        echo ($record);die;
        $data= array_map(function($record) {
                return $record->attributes;
        },$record);
        $result['totalPageCount'] = ceil($totalPageCount/$limit);
        $result['lists'] =  $data;
        return $result;
    }
    
   
}
