<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class RozkladForm extends ActiveRecord
{
    public $file;

    public $file2;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file', 'file2'], 'file', 'extensions' => 'xls'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'file'          => 'Розклад по групах',
            'file2'          => 'Розклад по викладачах'
        ];
    }
}
