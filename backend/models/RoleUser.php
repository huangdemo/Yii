<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_user".
 *
 * @property int $id
 * @property int $role_id 角色id
 * @property int $user_id 用户id
 * @property string $section 部门
 */
class RoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'user_id', 'section'], 'required'],
            [['role_id', 'user_id'], 'integer'],
            [['section'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => '角色id',
            'user_id' => '用户id',
            'section' => '部门',
        ];
    }
}
