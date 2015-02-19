<?php

namespace app\models;

use app\behaviors\PurifierBehavior;
use app\modules\admin\models\PredmetMetodychky;
use app\modules\admin\models\TeachPredmet;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "predmet".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 */
class Predmet extends ActiveRecord
{

    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [

            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['description'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['description'],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'predmet';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active'], 'required'],
            [['description'], 'string'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'description' => 'Опис',
            'active' => 'Активний чи ні',
        ];
    }

    /**
     * @return static
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['id' => 'teach_id'])
            ->viaTable(TeachPredmet::tableName(), ['predmet_id' => 'id']);
    }

    /**
     * @return static
     */
    public function getMetodychkies()
    {
        return $this->hasMany(Metodychky::className(), ['id' => 'metodychky_id'])
            ->viaTable(PredmetMetodychky::tableName(), ['predmet_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_PASSIVE => 'Неактивно',

        ];
    }

    /**
     * @param $active
     * @return mixed
     */
    public static function getStatus($active)
    {
        $status = self::getStatusArray();
        return $status[$active];
    }

    /**
     * @return mixed
     */
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
