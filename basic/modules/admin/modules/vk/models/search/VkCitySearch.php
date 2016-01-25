<?php

namespace app\modules\admin\modules\vk\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\modules\vk\models\VkCity;

/**
 * VkCitySearch represents the model behind the search form about `app\modules\admin\modules\vk\models\VkCity`.
 */
class VkCitySearch extends VkCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id'], 'integer'],
            [['title', 'area', 'region'], 'safe'],
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
        $query = VkCity::find();

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
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'region', $this->region]);

        return $dataProvider;
    }
}
