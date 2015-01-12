<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaticPage;

/**
 * SearchStaticPage represents the model behind the search form about `app\models\StaticPage`.
 */
class SearchStaticPage extends StaticPage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'parent_group_id'], 'integer'],
            [['alias', 'title', 'text'], 'safe'],
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
        $query = StaticPage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'parent_group_id' => $this->parent_group_id,
        ]);

        $query->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
