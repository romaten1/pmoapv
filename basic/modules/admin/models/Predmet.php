<?php

namespace app\modules\admin\models;

use Yii;
use app\models\Teacher;
use app\models\TeachPredmet;
use app\models\PredmetMetodychky;
use app\models\Metodychky;
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
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 255]
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
}
