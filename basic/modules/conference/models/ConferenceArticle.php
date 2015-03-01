<?php

namespace app\modules\conference\models;

use Yii;
use app\models\Root;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "conference_article".
 *
 * @property integer $id
 * @property integer $conference_id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 * @property string $author
 */
class ConferenceArticle extends Root
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
        return 'conference_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['conference_id', 'title', 'description', 'active', 'author'], 'required'],
            [['conference_id', 'created_at', 'updated_at', 'active'], 'integer'],
            [['description'], 'string'],
            [['title', 'author'], 'string', 'max' => 256],
	        [['file'], 'file', 'maxSize' => 20*1024*1024],
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
            'conference_id' => 'Науковий захід',
            'title' => 'Назва',
            'description' => 'Опис',
            'file' => 'Файл',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
            'author' => 'Автор',
        ];
    }
}
