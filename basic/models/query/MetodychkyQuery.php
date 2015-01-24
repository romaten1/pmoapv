<?php

namespace app\models\query;

use yii\db\ActiveQuery;
use Yii;
use app\models\Metodychky;

/**
 * Class MetodychkyQuery
 */
class MetodychkyQuery extends ActiveQuery
{
	public function active_metodychky()
	{
		$this->andWhere(['active' => Metodychky::STATUS_ACTIVE]);
		return $this;
	}

}
