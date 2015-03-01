<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\query\NewsQuery;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $image
 */
class News extends Root
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
        return 'news';
    }

	public static function find()
	{
		return new NewsQuery(get_called_class());
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],
            [['description'], 'string', 'max' => 1000],
	        [['text'], 'string', 'max' => 50000],
            [['active'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'gif, jpg, jpeg, tiff, png'],
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
