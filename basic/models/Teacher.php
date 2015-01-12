<?php

namespace app\models;

use Yii;
use app\models\Predmet;
use app\models\TeachMetodychky;
use app\models\Metodychky;
use app\models\TeachPredmet;
use app\models\TeacherNews;
use app\modules\admin\models\UserTeacher;
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
class Teacher extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
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

    public function getMetodychky()
    {
        return $this->hasMany(Metodychky::className(), ['id' => 'metodychky_id'])
                    ->viaTable(TeachMetodychky::tableName(), ['teach_id' => 'id']);
    }

    public function getPredmet()
    {
        return $this->hasMany(Predmet::className(), ['id' => 'predmet_id'])
                    ->viaTable(TeachPredmet::tableName(), ['teach_id' => 'id']);
    }
    
    public function getNews()
    {
        return $this->hasMany(TeacherNews::className(), ['teacher_id' => 'user_id'])
                    ->viaTable(UserTeacher::tableName(), ['teacher_id' => 'id']);
    }

    public static function getTeacherByUserId($user_id)
    {
        $teacher_id = UserTeacher::find()->where(['user_id'=>$user_id])->one()->teacher_id;
        $teacher = self::findOne($teacher_id);
        return $teacher;
    }
    
    public static function getPrepodsArray()
    {
        $teachers =[];
		$userteacher = UserTeacher::find()->all();
		foreach($userteacher as $user ){
			$teacher = Teacher::findOne($user->teacher_id);
        	$teacher_fullname = $teacher->last_name.' '.$teacher->name.' '.$teacher->second_name;
        	$teachers[$user->user_id] = $teacher_fullname;
        }
        return $teachers;
    }
        
    public static function getPrepod($user_id)
    {        		
		$teacher = self::getTeacherByUserId($user_id);
    	$teacher_fullname = $teacher->last_name.' '.$teacher->name.' '.$teacher->second_name;    	        
        return $teacher_fullname;
    }
}
