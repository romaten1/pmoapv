<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\PredmetMetodychky;

/**
 * PredmetMetodychkySearch represents the model behind the search form about `app\modules\admin\models\PredmetMetodychky`.
 */
class PredmetMetodychkySearch extends PredmetMetodychky
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'id', 'predmet_id', 'metodychky_id' ], 'integer' ],
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
    public function search( $params )
    {
        $query = PredmetMetodychky::find();

        $dataProvider = new ActiveDataProvider( [
            'query' => $query,
        ] );

        if ( ! ( $this->load( $params ) && $this->validate() )) {
            return $dataProvider;
        }

        $query->andFilterWhere( [
            'id'            => $this->id,
            'predmet_id'    => $this->predmet_id,
            'metodychky_id' => $this->metodychky_id,
        ] );

        return $dataProvider;
    }
}
