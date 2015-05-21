<?php

namespace app\models;

use app\models\query\BestStudentQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "best_student".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 */
class BestStudent extends Root
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new BestStudentQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'best_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'description', 'active'], 'required'],
            [['student_id', 'created_at', 'rating' , 'updated_at', 'active'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Студент',
            'description' => 'Опис',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
            'rating' => 'Рейтинг'
        ];
    }

    /**
     * Додає в змінну student моделі массив з даними про студента
     * @return static
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
