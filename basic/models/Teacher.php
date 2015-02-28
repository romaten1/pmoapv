<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use app\modules\admin\models\TeachMetodychky;
use app\modules\admin\models\TeachPredmet;
use dektrium\user\models\User;

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
 * @property integer $user_id
 * @property integer $teach_or_master -
 */
class Teacher extends ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
	const STATUS_TEACHER = 0;
	const STATUS_MASTER = 1;

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
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'second_name', 'last_name', 'job', 'description', 'teach_or_master'], 'required'],
            [['description'], 'string'],
            [['name', 'second_name', 'last_name', 'job', 'science_status', 'org_status'], 'string', 'max' => 100],
            [['image'], 'file', 'extensions' => 'gif, jpg',],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
	        ['teach_or_master', 'default', 'value' => self::STATUS_TEACHER],
	        ['teach_or_master', 'in', 'range' => [self::STATUS_TEACHER, self::STATUS_MASTER]],
	        ['user_id', 'integer'],
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
	        'user_id' => 'ID користувача',
	        'teach_or_master' => 'Викладач чи майстер',
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
        return $this->hasMany(TeacherNews::className(), ['teacher_id' => 'user_id']);
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

    /**
     * вертає об'єкт Teacher user_id якого згдіно таблиці UserTeacher відповідає введеному $user_id
     * @param $user_id
     * @return static
     */
    public static function getTeacherByUserId($user_id)
    {
        $teacher = self::find()->where(['user_id' => $user_id])->one();
        return $teacher;
    }

	public static function getUserByTeacherId($teacher_id)
	{
		$user_id = self::find()->where(['id' => $teacher_id])->one()->user_id;
		$user = User::findOne($user_id);
		return $user;
	}

    /**
     * вертає Повне ПІБ викладача на основі $user_id користувача, якщо користувач  є викладачем
     * @param $user_id
     * @return string
     */
    public static function getTeacherNameByUserId($user_id)
    {
        $teacher = self::find()->where(['user_id' => $user_id])->one();
        $teacher_name = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
        return $teacher_name;
    }

    /**
     * Вертає масив [UserId] => [Повне ПІБ викладача] всіх значень з таблиці UserTeacher
     * @return array
     */
    public static function getUserIdTeacherNameArray()
    {
        $user_teacher = self::find()->asArray()->all();
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
       return self::getUserIdTeacherNameArray();
    }

    /**
     * Вертає Повне ПІБ викладача по значенню $user_id користувача (якщо юзер - викладач)
     * @param $user_id
     * @return string
     */
    public static function getPrepod($user_id)
    {
        $teacher = self::find()->where(['user_id' => $user_id])->one();
        $teacher_fullname = $teacher->last_name . ' ' . $teacher->name . ' ' . $teacher->second_name;
        return $teacher_fullname;
    }

	/**
	 * @return array
	 */
	public static function getTeachMasterArray()
	{
		return [
			self::STATUS_TEACHER => 'Викладач',
			self::STATUS_MASTER => 'Майстер',

		];
	}
}
