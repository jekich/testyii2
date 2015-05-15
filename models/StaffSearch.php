<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Query;
use yii\db\Expression;

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
        $pagination = new Pagination();
        $pagination->pageSize = self::LIMIT_ITEMS_ON_PAGE;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'in_place' => $this->in_place,
        ]);

        if (!empty($this->group)) {

            $subQuery = (new Query)
                ->select([new Expression('1')])
                ->from('staff_group staff_group')
                ->where('staff.id = staff_group.staff_id')
                ->andWhere('staff_group.group_id = :group_id', [':group_id' => $this->group]);

            $query->andFilterWhere(['exists', $subQuery]);
        }

        if (!empty($this->skill)) {
            $subQuery = (new Query)
                ->select([new Expression('1')])
                ->from('staff_skill staff_skill')
                ->where('staff.id = staff_skill.staff_id')
                ->andWhere('staff_skill.skill_id = :skill_id', [':skill_id' => $this->skill]);

            $query->andFilterWhere(['exists', $subQuery]);
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
