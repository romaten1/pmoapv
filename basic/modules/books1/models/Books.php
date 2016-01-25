<?php

namespace app\modules\books\models;

use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_create
 * @property integer $date_update
 * @property string $preview
 * @property integer $date
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $date_min;

    public $date_max;

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_update',
                ]
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update', 'date', 'author_id'], 'required'],
            [['date_create', 'date_update', 'author_id'], 'integer'],
            [['name', 'preview', 'date',], 'string', 'max' => 255],
            [['date_min', 'date_max'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Дата обновления записи',
            'preview' => 'Обложка',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор',
            'date_min' => 'Дата выхода книги: от',
            'date_max' => 'до',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    /**
     * Переводим дату в Timestamp перед сохранением
     */
    public function beforeSave($insert)
    {
        $date = new DateTime($this->date);
        $this->date = $date->getTimestamp();
        return parent::beforeSave($insert);
    }
}
