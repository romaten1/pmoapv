<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Predmet;
use app\modules\admin\models\TeachMetodychky;
use app\modules\admin\models\Metodychky;
use app\modules\admin\models\TeachPredmet;
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
 * @property string $active
 */
class Teacher extends \app\models\Teacher
{
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
            [['image'], 'file', 'extensions' => 'gif, jpg, jpeg',],
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
            'active' => 'Активно чи ні',
        ];
    }    

    public static function getTeacherByUserId($user_id)
    {
        $teacher_id = UserTeacher::find()->where(['user_id'=>$user_id])->one()->teacher_id;
        $teacher = self::findOne($teacher_id);
        return $teacher;
    }

    public static function getTeacherNameByUserId($user_id)
    {
        $teacher_id = UserTeacher::find()->where(['user_id'=>$user_id])->one()->teacher_id;
        $teacher = self::findOne($teacher_id);
        $teacher_name = $teacher->last_name.' '.$teacher->name.' '.$teacher->second_name;
        return $teacher_name;
    }

    public static function getUserIdTeacherNameArray()
    {
        $user_teacher = UserTeacher::find()->asArray()->all();
        $teachers = [];       
        foreach ($user_teacher as $item) {
            $teacher = self::getTeacherByUserId($item['user_id']);
            $teachers[$item['user_id']] = $teacher->last_name.' '.$teacher->name.' '.$teacher->second_name;
        }
        return $teachers;
    }
}
