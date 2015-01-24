<?php

namespace app\models\query;

use yii\db\ActiveQuery;
use Yii;
use app\models\News;

/**
 * Class NewsQuery
 */
class NewsQuery extends ActiveQuery
{
	public function active_news()
	{
		$this->andWhere(['active' => News::STATUS_ACTIVE]);
		return $this;
	}

}
