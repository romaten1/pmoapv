<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the root model class with "active" methods and constants.
 *
 *
 */
class Root extends ActiveRecord
{
	const STATUS_PASSIVE = 0; // записи не показуються на фронті
	const STATUS_ACTIVE = 1; // записи активні, показуються на фронті

	public static function getStatusArray()
	{
		return [
			self::STATUS_ACTIVE => 'Активно',
			self::STATUS_PASSIVE => 'Неактивно',
		];
	}

	public static function getStatus($active)
	{
		$status = self::getStatusArray();
		return $status[$active];
	}

	public function getStatusLabel()
	{
		$statuses = $this->getStatusArray();
		if($this->active == self::STATUS_ACTIVE ){
			$return = '<span class="label label-success">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
		}
		else {
			$return = '<span class="label label-warning">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
		}
		return $return;
	}
}