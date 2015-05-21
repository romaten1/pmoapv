<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $second_name
 * @property string $image
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 */
class Student extends Root
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

    public $fullName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'second_name', 'group_id', 'active'], 'required'],
            [['group_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['first_name', 'second_name'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 255],
            [['fullName'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Ім\'я',
            'second_name' => 'Прізвище',
            'image' => 'Фото',
            'group_id' => 'Група',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
        ];
    }

    /**
     * Додає в змінну student моделі массив з даними про студента
     * @return static
     */
    public function getGroup()
    {
        return $this->hasOne(StudentGroup::className(), ['id' => 'group_id']);
    }

    /**
     * вертає ПІ студента
     * @return string
     */
    public static function getFullName($id)
    {
        $student = Student::find()->where(['id' => $id])->one();
        return $student->second_name . ' '. $student->first_name;
    }

    /**
     * вертає ПІ студента
     * @return string
     */
    public static function getStudentsArray()
    {
        $students = Student::find()->all();
        $array = [];
        foreach($students as $student){
            $array[$student->id] = $student->second_name . ' '. $student->first_name;
        }
        return $array;
    }
}
