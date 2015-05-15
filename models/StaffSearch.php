<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * StaffSearch represents the model behind the search form about `app\models\Staff`.
 */
class StaffSearch extends Staff
{
    const LIMIT_ITEMS_ON_PAGE = 20;

    public $group;
    public $skill;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'in_place'], 'integer'],
            [['name', 'group', 'skill'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Staff::find();
        $query->joinWith(['staffGroups', 'staffSkills']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => self::LIMIT_ITEMS_ON_PAGE,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'in_place' => $this->in_place,
            'staff_group.group_id' => $this->group,
            'staff_skill.skill_id' => $this->skill,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
