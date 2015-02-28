<?php

namespace app\modules\conference\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "conference".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 * @property integer $conference_date
 */
class Conference extends \yii\db\ActiveRecord
{
	const STATUS_PASSIVE = 0;
	const STATUS_ACTIVE = 1;

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active', 'conference_date'], 'required'],
            [['title', 'description', 'conference_date'], 'string'],
	        ['active', 'default', 'value' => self::STATUS_ACTIVE],
	        ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва заходу',
            'description' => 'Опис',
            'active' => 'Активно',
	        'conference_date' => 'Дата проведення'
        ];
    }
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

	public static function getConferenceArray(){
		$conferences = self::find()->asArray()->all();
		$result = [];
		foreach($conferences as $val){
			$result[$val['id']] = $val['title'];
		}
		return $result;
	}

	public static function getConferenceLabel($conference_id)
	{
		$status = self::getConferenceArray();
		return $status[$conference_id];
	}

}
