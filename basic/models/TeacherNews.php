<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "teacher_news".
 *
 * @property integer $id
 * @property integer $teacher_id
 * @property string $title
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 */
class TeacherNews extends Root
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ],
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
	                ActiveRecord::EVENT_BEFORE_UPDATE => ['text', 'title'],
	                ActiveRecord::EVENT_BEFORE_INSERT => ['text', 'title'],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'title', 'text', 'active'], 'required'],
            [['teacher_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'teacher_id' => 'Викладач',
            'title' => 'Назва',
            'text' => 'Текст',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
        ];
    }

	public function getTeacher()
	{
		return $this->hasOne(Teacher::className(), ['id' => 'teach_id']);
	}
}
