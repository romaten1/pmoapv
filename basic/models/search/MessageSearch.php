<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;


/**
 * MessageSearch represents the model behind the search form about `app\modules\admin\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'receiver_id', 'created_at', 'recieved_at', 'active'], 'integer'],
            [['text'], 'safe'],
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
     * Only with received_messages
     *
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Message::find()->received_messages();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'receiver_id' => $this->receiver_id,
            'created_at' => $this->created_at,
            'recieved_at' => $this->recieved_at,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchAll($params)
	{
		$query = Message::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10
			]
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'author_id' => $this->author_id,
			'receiver_id' => $this->receiver_id,
			'created_at' => $this->created_at,
			'recieved_at' => $this->recieved_at,
			'active' => $this->active,
		]);

		$query->andFilterWhere(['like', 'text', $this->text]);

		return $dataProvider;
	}
}
