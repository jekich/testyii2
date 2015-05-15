<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "staff".
 *
 * @property string $id
 * @property string $name
 *
 * @property StaffGroup[] $staffGroups
 * @property StaffSkill[] $staffSkills
 */
class Staff extends \yii\db\ActiveRecord
{
    const TYPE_IN_PLACE_YES = 1;
    const TYPE_IN_PLACE_NO = 0;


    public static function getTypeInPlace() {
        return [
            self::TYPE_IN_PLACE_NO,
            self::TYPE_IN_PLACE_YES
        ];
    }

    public static function getTypeInPlaceList() {
        return [
            self::TYPE_IN_PLACE_NO => 'Нет',
            self::TYPE_IN_PLACE_YES => 'Да'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['in_place'], 'integer'],
            [['in_place'], 'range', 'allowArray' => self::getTypeInPlace()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Фамилия',
            'in_place' => 'На месте',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])
            ->via('staffGroups');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffGroups()
    {
        return $this->hasMany(StaffGroup::className(), ['staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])
            ->via('staffSkills');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffSkills()
    {
        return $this->hasMany(StaffSkill::className(), ['staff_id' => 'id']);
    }
}
