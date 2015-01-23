<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $image
 */
class News extends ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;

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
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['description'],
                    ActiveRecord::EVENT_BEFORE_INSERT => ['description'],
                ]
            ]
        ];
    }

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
            [['description', 'text'], 'string', 'max' => 1000],
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

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_PASSIVE => 'Неактивно',

        ];
    }

    /**
     * @param $active
     * @return mixed
     */
    public static function getStatus($active)
    {
        $status = self::getStatusArray();
        return $status[$active];
    }

    /**
     * @return mixed
     */
	public function getStatusLabel()
	{
		$statuses = $this->getStatusArray();
		if($this->active == self::STATUS_ACTIVE ){
			$return = '<span class="label label-success">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
		}
		else {
			$return = '<span class="label label-warning">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
		}
		return $return;
	}
}
