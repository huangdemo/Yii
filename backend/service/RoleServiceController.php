<?php

namespace backend\service;
use backend\Service\CommonServiceController;
use app\models\Role;
use app\models\RoleUser;
use common\helps\tools;

class RoleServiceController extends CommonServiceController {
    
    /**
     * 添加或者修改后台用户
     * @param type $post  数据
     * @param type $bool true 添加  false 修改
     * @return type 
     */
    public function AddRole($post,$bool=true)
    {
        $Role = new Role();
        if($bool){
            $AdminUser->load($post, ''); //批量插入
            if ($AdminUser->validate() && $AdminUser->save()) {
                return true;
            } else {
                $error = tools::error($AdminUser->getFirstErrors());//失败返回错误
                return $error;
            }
        }else{
            $AdminUser->load($post, ''); //批量修改
            $id = $post['id'];
            unset($post['id']);
            if ($AdminUser->validate() && $AdminUser->updateAll($post,['id'=>$id])) {
                return true;
            } else {
                $error = tools::error($AdminUser->getFirstErrors());//失败返回错误
                return $error;
            }
        }
    }
    
    /**
     * 当前用户所有角色和系统所有角色
     * @param array $condition 
     * @param bool $bool  是否系统所有角色
     * @param int $limit
     * @param int $page
     * @param string $order
     * @return array
     */
    public function RoleList($condition=[],$bool,$limit=9,$page=1,$order="list_order desc")
    {
       
        if($bool){
            $roleList = Role::find()
                ->from('role as r')
                ->select('r.name,r.id,r.remark')
                ->where(['status'=>$condition['status']])
                ->orderBy($order)
                ->asArray()
                ->all();

            $RoleUser = RoleUser::find()->count();
            $roleUserList = RoleUser::find()
                        ->from('role_user as ru')
                        ->select('r.name,r.id,r.remark')
                        ->join('LEFT JOIN','role as r','r.id=ru.role_id')
                        ->where(['user_id'=>$condition['user_id']])
                        ->asArray()
                        ->all();
      
                // ->createCommand()->getRawSql();
                // echo $record;die;
        }
        foreach ($roleList as $k => &$v) {
            foreach ($roleUserList as $key => $val) {
                if($v['id'] === $val['id']){
                    unset($roleList[$k]);
                }
            }
               
        }
        $result['lists'] =  array_merge($roleList);
        $result['list'] =  $roleUserList;
        return $result;
    }
    
    public function UserDetailed($condition=[])
    {
        try {
            $result = AdminUser::find()
                ->select('*')
                ->where($condition)
                ->one();
        } catch (Exception $exc) {
           
            return false;
        }

        return $result->attributes;
    }
   
}
