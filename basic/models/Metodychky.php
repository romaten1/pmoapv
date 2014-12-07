<?php

namespace app\models;

use Yii;

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
        ];
    }
}
