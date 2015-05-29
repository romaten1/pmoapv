<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "diploma".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property integer $rating
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 */
class Diploma extends Root
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diploma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'rating', 'active'], 'required'],
            [['rating', 'created_at', 'updated_at', 'active'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255]
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
            'image' => 'Фото',
            'rating' => 'Рейтинг',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
        ];
    }
}
