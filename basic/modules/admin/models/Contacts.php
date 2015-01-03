<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 */
class Contacts extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 0;
    const STATUS_REVIEWED = 1;

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['reviewed_at'],                    
                ]
            ],            
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'email', 'subject', 'body'], 'string', 'max' => 255],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_REVIEWED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ім\'я користувача',
            'email' => 'Email',
            'subject' => 'Тема повідомлення',
            'body' => 'Текст повідомлення',
            'active' => 'Переглянуто',
            'created_at' => 'Дата створення',
            'reviewed_at' => 'Дата перегляду',
        ];
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Непереглянуто',
            self::STATUS_REVIEWED => 'Переглянуто',            
        ];
    }

    public static function getStatus($active)
    {
        $status = self::getStatusArray();
        return $status[$active];
    }

    public function getStatusLabel()
    {
        $statuses = $this->getStatusArray();
        return ArrayHelper::getValue($statuses, $this->active);
    }
}
