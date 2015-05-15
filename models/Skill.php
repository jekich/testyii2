<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property string $id
 * @property string $name
 *
 * @property StaffSkill[] $staffSkills
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill';
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
    public function getStaffSkills()
    {
        return $this->hasMany(StaffSkill::className(), ['skill_id' => 'id']);
    }
}
