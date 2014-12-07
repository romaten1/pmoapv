<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TeachMetodychky;

/**
 * TeachMetodychkySearch represents the model behind the search form about `app\models\TeachMetodychky`.
 */
class TeachMetodychkySearch extends TeachMetodychky
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'teach_id', 'metodychky_id'], 'integer'],
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
        $query = TeachMetodychky::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'teach_id' => $this->teach_id,
            'metodychky_id' => $this->metodychky_id,
        ]);

        return $dataProvider;
    }
}
