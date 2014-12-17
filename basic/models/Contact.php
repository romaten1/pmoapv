<?php

namespace app\models;

use Yii;


/**
 * ContactForm is the model behind the contact form.
 */
class Contact extends \yii\db\ActiveRecord
{
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    

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
            [['name', 'subject', 'body'], 'string', 'max' => 255],
            // verifyCode needs to be entered correctly
            ['captcha', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ім\'я',
            'email' => 'Електронна пошта',
            'subject' => 'Тема повідомлення',
            'body' => 'Текст повідомлення',
            'captcha' => 'Код підтвердження',
        ];
    }


}
