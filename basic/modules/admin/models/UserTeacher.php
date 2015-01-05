<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_teacher".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $teacher_id
 */
class UserTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'teacher_id'], 'required'],
            [['user_id', 'teacher_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'teacher_id' => 'Teacher ID',
        ];
    }
}
