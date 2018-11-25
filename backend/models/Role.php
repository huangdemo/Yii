<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property int $pid 父id
 * @property string $name 角色名称
 * @property string $remark 备注
 * @property int $status 状态
 * @property string $create_time 创建时间
 * @property string $update_time 修改时间
 * @property int $list_order 排序
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'status', 'list_order'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => '父id',
            'name' => '角色名称',
            'remark' => '备注',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'list_order' => '排序',
        ];
    }
}
