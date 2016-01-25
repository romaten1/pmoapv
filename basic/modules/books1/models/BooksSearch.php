<?php

namespace app\modules\books\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BooksSearch represents the model behind the search form about `app\modules\books\models\Books`.
 */
class BooksSearch extends Books
{
    public $date_min;

    public $date_max;

    public $author;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_create', 'date_update', 'date', 'author_id'], 'integer'],
            [['name', 'preview', 'date_min', 'date_max', 'author'], 'safe'],
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
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
        ]);

        // Обрабатываем входящий запрос фильтра даты от и до с получением Timestamp
        $date_min = Yii::$app->request->queryParams['BooksSearch']['date_min'];
        $date_min_value = new DateTime($date_min);
        $date_min_value = $date_min_value->getTimestamp();

        $date_max = Yii::$app->request->queryParams['BooksSearch']['date_max'];
        $date_max_value = new DateTime($date_max);

        $date_max_value = $date_max_value->getTimestamp();
        //ddd($date_max);
        if (!empty($date_min) && !empty($date_max)) {
            $query->andFilterWhere(['between', 'date', $date_min_value, $date_max_value]);
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
