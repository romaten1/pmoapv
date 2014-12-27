<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Teacher;
use app\modules\admin\models\TeachPredmet;
use app\modules\admin\models\PredmetMetodychky;
use app\modules\admin\models\Metodychky;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "predmet".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 */
class Predmet extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'predmet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
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
            'title' => 'Назва',
            'description' => 'Опис',
            'active' => 'Активний чи ні',
        ];
    }
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['id' => 'teach_id'])
                    ->viaTable(TeachPredmet::tableName(), ['predmet_id' => 'id']);
    }

    public function getMetodychkies()
    {
        return $this->hasMany(Metodychky::className(), ['id' => 'metodychky_id'])
                    ->viaTable(PredmetMetodychky::tableName(), ['predmet_id' => 'id']);
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
        return ArrayHelper::getValue($statuses, $this->active);
    }
}
