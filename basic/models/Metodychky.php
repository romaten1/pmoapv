<?php

namespace app\models;

use Yii;
use app\modules\admin\models\TeachMetodychky;
use app\models\query\MetodychkyQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "metodychky".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property integer $active
 * @property string $size
 */
class Metodychky extends Root
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
        return 'metodychky';
    }

    public static function find()
    {
        return new MetodychkyQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'active'], 'required'],
            [['description'], 'string'],
            [['active', 'size'], 'integer'],
            [['title'], 'string', 'max' => 255],
	        [['file'], 'file', 'maxSize' => 50*1024*1024],
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
            'title' => 'Назва',
            'description' => 'Опис',
            'file' => 'Файл',
            'active' => 'Активно чи ні',
            'created_at' => 'Дата створення запису',
            'updated_at' => 'Дата оновлення запису',
            'size' => 'Розмір файлу',
        ];
    }

	public function getTeachers()
	{
		return $this->hasMany(Teacher::className(), ['id' => 'teach_id'])
		            ->viaTable(TeachMetodychky::tableName(), ['metodychky_id' => 'id']);
	}
}
