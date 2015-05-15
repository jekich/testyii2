<?php
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use \app\models\Skill;
use \app\models\Group;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h1>Список сотрудников</h1>

    <div class="body-content">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'label' => 'Группа',
                    'attribute' => 'group',
                    'value' => function ($model) {
                        $groups = ArrayHelper::map($model->groups, 'id', 'name');
                        return implode(', ',$groups);
                    },
                    'filter' => ArrayHelper::map(Group::find()->all(), 'id', 'name')
                ],
                [
                    'label' => 'Навыки',
                    'attribute' => 'skill',
                    'value' => function ($model) {
                        $groups = ArrayHelper::map($model->skills, 'id', 'name');
                        return implode(', ',$groups);
                    },
                    'filter' => ArrayHelper::map(Skill::find()->all(), 'id', 'name')
                ],
                [
                    'attribute' => 'in_place',
                    'value' => function ($model) {
                        return $model->in_place ? 'Да' : 'Нет';
                    },
                    'filter' => \app\models\Staff::getTypeInPlaceList()
                ]
            ],
        ]) ?>

    </div>
</div>
