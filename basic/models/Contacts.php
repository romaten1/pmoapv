<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
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
class Contacts extends ActiveRecord
{
    const STATUS_ACTIVE = 0;
    const STATUS_REVIEWED = 1;

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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['subject', 'body'],
                ]
            ]
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
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'active' => 'Переглянуто',
            'created_at' => 'Дата створення',
            'reviewed_at' => 'Дата перегляду',

        ];
    }

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Непереглянуто',
            self::STATUS_REVIEWED => 'Переглянуто',
        ];
    }

    /**
     * Вертає 'Непереглянуто' або 'Переглянуто'
     * @param $active
     * @return mixed
     */
    public static function getStatus($active)
    {
	    $status = self::getStatusArray();
	    return $status[$active];
    }

    public function getStatusLabel()
    {
        $statuses = $this->getStatusArray();
	    if($this->active == self::STATUS_REVIEWED ){
	        $return = '<span class="label label-success">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
	    }
	    else {
		    $return = '<span class="label label-warning">'.ArrayHelper::getValue($statuses, $this->active).'</span>';
	    }
        return $return;
    }
}
