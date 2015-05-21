<?php

namespace app\models\query;

use app\models\BestStudent;
use yii\db\ActiveQuery;
use Yii;
/**
 * Class MetodychkyQuery
 */
class BestStudentQuery extends ActiveQuery
{
	public function active()
	{
		$this->andWhere(['active' => BestStudent::STATUS_ACTIVE]);
		return $this;
	}

}
