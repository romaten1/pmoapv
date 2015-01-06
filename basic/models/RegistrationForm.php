<?php

namespace app\models;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $captcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['captcha', 'required'];
        $rules[] = ['captcha', 'captcha','captchaAction'=>'/user/registration/captcha'];
        return $rules;
    }
}