<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property string $id
 * @property string $name 用户名
 * @property string $user 账号
 * @property string $password 密码
 * @property int $age 性别
 * @property string $phone 手机号
 * @property string $explain 说明
 * @property string $birth 出生日期 
 * @property string $portrait 头像
 * @property string $add_time 账号申请时间
 * @property string $is_status 是否禁止登陆  0为禁止  1为正常
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user', 'password'], 'required','message' => '{attribute}不能为空'],
            [['age'], 'integer','message' => '{attribute}必须为数字'],
            [['name', 'user'], 'string', 'max' => 20,'message' => '{attribute}长度不能超过20'],
            [['password'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 11],
            [['explain'], 'string', 'max' => 255],
            [['portrait'], 'string', 'max' => 100],
            [['birth', 'add_time'], 'string', 'max' => 30],
            [['is_status'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '用户名',
            'user' => '账号',
            'password' => '密码',
            'age' => '性别',
            'phone' => '手机号',
            'explain' => '说明',
            'birth' => '出生日期',
            'portrait' => '头像',
            'add_time' => '账号申请时间',
            'is_status' => '是否禁止登陆  0为禁止  1为正常',
        ];
    }
}
