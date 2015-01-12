<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `app\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'second_name', 'last_name', 'image', 'job', 'science_status', 'org_status', 'description'], 'safe'],
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
        $query = Teacher::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'science_status', $this->science_status])
            ->andFilterWhere(['like', 'org_status', $this->org_status])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
