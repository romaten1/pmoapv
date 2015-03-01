<?php

namespace app\modules\conference\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Root;

/**
 * This is the model class for table "conference".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 * @property integer $conference_date
 */
class Conference extends Root
{
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
