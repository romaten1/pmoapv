<?php

namespace app\models;

use Yii;
use app\modules\admin\models\UserTeacher;
use yii\helpers\ArrayHelper;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $second_name
 * @property string $last_name
 * @property string $image
 * @property string $job
 * @property string $science_status
 * @property string $org_status
 * @property string $description
 */
class Teacher extends ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;

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
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'second_name', 'last_name', 'job', 'description'], 'required'],
            [['description'], 'string'],
            [['name', 'second_name', 'last_name', 'job', 'science_status', 'org_status'], 'string', 'max' => 100],
            [['image'], 'file', 'extensions' => 'gif, jpg',],
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
            'name' => 'Ім\'я викладача',
            'second_name' => 'По-батькові',
            'last_name' => 'Прізвище',
            'image' => 'Фото',
            'job' => 'Посада',
            'science_status' => 'Науковий ступінь',
            'org_status' => 'Організаційна посада',
            'description' => 'Короткий опис',
        ];
    }

    /**
     * Додає в змінну metodychky моделі массив з усіма методичками даного викладача
     * @return static
     */
    public function getMetodychky()
    {
        return $this->hasMany(Metodychky::className(), ['id' => 'metodychky_id'])
            ->viaTable(TeachMetodychky::tableName(), ['teach_id' => 'id']);
    }

    /**
     * Додає в змінну predmet моделі массив з усіма предметами даного викладача
     * @return static
     */
    public function getPredmet()
    {
        return $this->hasMany(Predmet::className(), ['id' => 'predmet_id'])
            ->viaTable(TeachPredmet::tableName(), ['teach_id' => 'id']);
    }

    /**
     * Додає в змінну news моделі массив з усіма особистими повідомленнями(новинами) даного викладача
     * @return static
     */
    public function getNews()
    {
        return $this->hasMany(TeacherNews::className(), ['teacher_id' => 'user_id'])
            ->viaTable(UserTeacher::tableName(), ['teacher_id' => 'id']);
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
        return ArrayHelper::getValue($statuses, $this->active);
    }

    /**
     * вертає об'єкт Teacher user_id якого згдіно таблиці UserTeacher відповідає введеному $user_id
     * @param $user_id
     * @return static
     */
    public static function getTeacherByUserId($user_id)
    {
        $teacher_id = UserTeacher::find()->where(['user_id' => $user_id])->one()->teacher_id;
        $teacher = self::findOne($teacher_id);
        return $teacher;
    }

    /**
     * вертає Повне ПІБ викладача на основі $user_id користувача, якщо користувач  є викладачем
     * @param $user_id
     * @return string
     */
    public static function getTeacherNameByUserId($user_id)
    {
        $teacher_id = UserTeacher::find()->where(['user_id' => $user_id])->one()->teacher_id;
        $teacher = self::findOne($teacher_id);
        $teacher_name = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
        return $teacher_name;
    }

    /**
     * Вертає масив [UserId] => [Повне ПІБ викладача] всіх значень з таблиці UserTeacher
     * @return array
     */
    public static function getUserIdTeacherNameArray()
    {
        $user_teacher = UserTeacher::find()->asArray()->all();
        $teachers = [];
        foreach ($user_teacher as $item) {
            $teacher = self::getTeacherByUserId($item['user_id']);
            $teachers[$item['user_id']] = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
        }
        return $teachers;
    }

    /**
     * Аналогічна функції  getUserIdTeacherNameArray()??
     * Вертає масив [UserId] => [Повне ПІБ викладача] всіх значень з таблиці UserTeacher
     * @return array
     */
    public static function getPrepodsArray()
    {
        $teachers = [];
        $userteacher = UserTeacher::find()->all();
        foreach ($userteacher as $user) {
            $teacher = self::findOne($user->teacher_id);
            $teacher_fullname = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
            $teachers[$user->user_id] = $teacher_fullname;
        }
        return $teachers;
    }

    /**
     * Вертає Повне ПІБ викладача по значенню $user_id користувача (якщо юзер - викладач)
     * @param $user_id
     * @return string
     */
    public static function getPrepod($user_id)
    {
        $teacher = self::getTeacherByUserId($user_id);
        $teacher_fullname = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
        return $teacher_fullname;
    }
}
