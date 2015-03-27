<?php

namespace app\models\query;

use yii\db\ActiveQuery;
use Yii;
use app\models\Predmet;

/**
 * Class PredmetQuery
 */
class PredmetQuery extends ActiveQuery
{
	public function active_predmet()
	{
		$this->andWhere(['active' => Predmet::STATUS_ACTIVE]);
		return $this;
	}

}
