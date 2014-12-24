<?php

namespace app\models;

use Yii;
use app\models\TeachMetodychky;
use app\models\Teacher;
/**
 * This is the model class for table "metodychky".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property integer $active
 */
class Metodychky extends \yii\db\ActiveRecord
{
    
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metodychky';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active'], 'required'],
            [['description'], 'string'],
            [['active'], 'integer'],
            [['title', 'file'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'description' => 'Опис',
            'file' => 'Файл',
            'active' => 'Активно чи ні',
            'created_at' => 'Дата створення запису',
            'updated_at' => 'Дата оновлення запису',
        ];
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_PASSIVE => 'Неактивно',            
        ];
    }

    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['id' => 'teach_id'])
                    ->viaTable(TeachMetodychky::tableName(), ['metodychky_id' => 'id']);
    }

    

    
}
