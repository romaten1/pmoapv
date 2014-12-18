<?php

namespace app\modules\admin\models;

use Yii;

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
}
