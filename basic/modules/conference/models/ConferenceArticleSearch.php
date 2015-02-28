<?php

namespace app\modules\conference\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\conference\models\ConferenceArticle;

/**
 * ConferenceArticleSearch represents the model behind the search form about `app\modules\conference\models\ConferenceArticle`.
 */
class ConferenceArticleSearch extends ConferenceArticle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'conference_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['title', 'description', 'file', 'author'], 'safe'],
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
        $query = ConferenceArticle::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'conference_id' => $this->conference_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
