<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\HtmlPurifier;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $active;
    public $created_at;
    public $reviewed_at;

    const STATUS_ACTIVE = 0;
    const STATUS_REVIEWED = 1;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_REVIEWED]],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ваше ім\'я',
            'email' => 'Email',
            'subject' => 'Тема повідомлення',
            'body' => 'Текст повідомлення',
            'verifyCode' => 'Код перевірки',
            'active' => 'Переглянуто',
            'created_at' => 'Дата створення',
            'reviewed_at' => 'Дата перегляду',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            /*Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();*/
            $contacts = new Contacts();
            $contacts->name = HtmlPurifier::process($this->name);
            $contacts->email = HtmlPurifier::process($this->email);
	        $contacts->subject = HtmlPurifier::process($this->subject);
            $contacts->body = HtmlPurifier::process($this->body);
            $contacts->active = self::STATUS_ACTIVE;
            //$contacts->created_at = time();
            $contacts->reviewed_at = '1';

            if ($contacts->save()) {
                return true;
            } else {
                return false;
            }
        }
    }
}
