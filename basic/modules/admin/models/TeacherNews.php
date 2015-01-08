<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;

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
class TeacherNews extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;

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
                        ActiveRecord::EVENT_BEFORE_INSERT => ['text'],
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
            [['teacher_id', 'title', 'text', 'created_at', 'updated_at', 'active'], 'required'],
            [['teacher_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['text'], 'string'],
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
            'teacher_id' => 'Викладач',
            'title' => 'Назва',
            'text' => 'Текст',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
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
        return ArrayHelper::getValue($statuses, $this->active);
    }
}
