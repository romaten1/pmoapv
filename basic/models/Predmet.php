<?php

namespace app\models;

use app\modules\admin\models\PredmetMetodychky;
use app\modules\admin\models\TeachPredmet;
use Yii;

/**
 * This is the model class for table "predmet".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $active
 */
class Predmet extends Root
{

   /**
     * @return array
     */
    public function behaviors()
    {
        return [

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
}
