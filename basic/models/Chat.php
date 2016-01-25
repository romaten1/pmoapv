<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property ChatMessage[] $chatMessages
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages()
    {
        return $this->hasMany(ChatMessage::className(), ['chat_id' => 'id']);
    }

    public static function getChatsArray()
    {
        $chats = self::find()->asArray()->all();
        $result = [];
        foreach ($chats as $chat) {
            $result[$chat['id']] = $chat['title'];
        }
        return $result;
    }
}
