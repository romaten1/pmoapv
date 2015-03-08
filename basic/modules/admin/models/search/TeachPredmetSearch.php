<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\TeachPredmet;

/**
 * TeachPredmetSearch represents the model behind the search form about `app\modules\admin\models\TeachPredmet`.
 */
class TeachPredmetSearch extends TeachPredmet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'id', 'teach_id', 'predmet_id' ], 'integer' ],
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
        $query = TeachPredmet::find();

        $dataProvider = new ActiveDataProvider( [
            'query' => $query,
        ] );

        if ( ! ( $this->load( $params ) && $this->validate() )) {
            return $dataProvider;
        }

        $query->andFilterWhere( [
            'id'         => $this->id,
            'teach_id'   => $this->teach_id,
            'predmet_id' => $this->predmet_id,
        ] );

        return $dataProvider;
    }
}
