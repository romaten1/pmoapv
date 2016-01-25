<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;
use app\models\query\MessageQuery;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $author_id
 * @property integer $receiver_id
 * @property string $text
 * @property integer $created_at
 * @property integer $recieved_at
 * @property integer $active
 */
class Message extends Root
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['text','receiver_id'],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'text'], 'required'],
            [['author_id', 'receiver_id', 'created_at', 'recieved_at', 'active'], 'integer'],
            [['text'], 'string', 'max' => 12000],
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
            'id' => 'id',
            'author_id' => 'Автор',
            'receiver_id' => 'Отримувач',
            'text' => 'Текст',
            'created_at' => 'Створено',
            'recieved_at' => 'Отримано',
            'active' => 'Активно',
        ];
    }

	public static function getNotRecievedMessageCount()
	{
		$count = self::find()
		             ->received_messages()
		             ->where(['receiver_id' => Yii::$app->user->id])
		             ->andWhere('recieved_at < 2')
		             ->count();
		return $count;
	}
}
