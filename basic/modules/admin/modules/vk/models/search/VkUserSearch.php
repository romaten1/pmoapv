<?php

namespace app\modules\admin\modules\vk\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\modules\vk\models\VkUser;

/**
 * VkUserSearch represents the model behind the search form about `app\modules\admin\modules\vk\models\VkUser`.
 */
class VkUserSearch extends VkUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sex', 'city_id', 'school_id', 'school_city_id', 'school_year_to', 'last_seen', 'can_post', 'can_write_private_message', 'active', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'bdate', 'city_title', 'country', 'photo_200_orig', 'domain', 'school_name', 'description'], 'safe'],
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
        $query = VkUser::find();

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
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'city_id' => $this->city_id,
            'school_id' => $this->school_id,
            'school_city_id' => $this->school_city_id,
            'school_year_to' => $this->school_year_to,
            'last_seen' => $this->last_seen,
            'can_post' => $this->can_post,
            'can_write_private_message' => $this->can_write_private_message,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'bdate', $this->bdate])
            ->andFilterWhere(['like', 'city_title', $this->city_title])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'photo_200_orig', $this->photo_200_orig])
            ->andFilterWhere(['like', 'domain', $this->domain])
            ->andFilterWhere(['like', 'school_name', $this->school_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
