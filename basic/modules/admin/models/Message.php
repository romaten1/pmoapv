<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
class Message extends \app\models\Message
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
                        ActiveRecord::EVENT_BEFORE_INSERT => ['text'],
                    ]
                ]
            ];
    }
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'receiver_id', 'text', 'created_at', 'recieved_at', 'active'], 'required'],
            [['author_id', 'receiver_id', 'created_at', 'recieved_at', 'active'], 'integer'],
            [['text'], 'string'],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
        ];
    }    

    
}
