<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Root
{
    public $verifyCode;

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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['subject', 'body', 'name', 'email'],
                ]
            ]
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [ [ 'name', 'email', 'subject', 'body' ], 'required' ],
            // email has to be a valid email address
            [ 'email', 'email' ],
            // verifyCode needs to be entered correctly
            [ 'verifyCode', 'required' ],
            [ 'verifyCode', 'captcha', 'captchaAction'=>'/site/captcha' ],
            [ 'active', 'default', 'value' => self::STATUS_ACTIVE ],
            [ 'active', 'in', 'range' => [ self::STATUS_ACTIVE, self::STATUS_REVIEWED ] ],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Ваше ім\'я',
            'email'       => 'Email',
            'subject'     => 'Тема повідомлення',
            'body'        => 'Текст повідомлення',
            'verifyCode'  => 'Код перевірки',
            'active'      => 'Переглянуто',
            'created_at'  => 'Дата створення',
            'reviewed_at' => 'Дата перегляду',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }
}
