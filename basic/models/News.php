<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $image
 */
class News extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],
            [['description', 'text'], 'string'],
            [['active'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
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
            'title' => 'Заголовок новини',
            'description' => 'Короткий опис',
            'text' => 'Текст новини',
            'image' => 'Фото',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
            'active' => 'Активно чи ні',
        ];
    }
}
