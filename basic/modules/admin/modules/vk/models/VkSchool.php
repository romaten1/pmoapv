<?php

namespace app\modules\admin\modules\vk\models;

use Yii;

/**
 * This is the model class for table "vk_school".
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $title
 * @property integer $city_id
 */
class VkSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'city_id'], 'required'],
            [['school_id', 'city_id'], 'integer'],
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
            'school_id' => 'School ID',
            'title' => 'Title',
            'city_id' => 'City ID',
        ];
    }
}
