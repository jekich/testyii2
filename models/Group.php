<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property string $id
 * @property string $name
 *
 * @property StaffGroup[] $staffGroups
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffGroups()
    {
        return $this->hasMany(StaffGroup::className(), ['group_id' => 'id']);
    }
}
