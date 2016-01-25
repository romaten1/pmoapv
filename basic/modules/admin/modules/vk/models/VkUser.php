<?php

namespace app\modules\admin\modules\vk\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vk_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $sex
 * @property string $bdate
 * @property integer $city_id
 * @property string $city_title
 * @property string $country
 * @property string $photo_200_orig
 * @property string $domain
 * @property integer $school_id
 * @property integer $school_city_id
 * @property string $school_name
 * @property integer $school_year_to
 * @property integer $last_seen
 * @property integer $can_post
 * @property integer $can_write_private_message
 * @property string $description
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 */
class VkUser extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'sex',  'city_id', 'school_id', 'school_city_id', 'school_year_to', 'last_seen', 'can_post', 'can_write_private_message', 'active', 'created_at', 'updated_at'], 'integer'],
            [['description', 'bdate',], 'string'],
            [['first_name', 'last_name', 'city_title', 'country', 'photo_200_orig', 'domain', 'school_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID користувача',
            'first_name' => 'Імя',
            'last_name' => 'Прізвище',
            'sex' => 'Стать',
            'bdate' => 'Дата народження',
            'city_id' => 'ID міста',
            'city_title' => 'Назва міста',
            'country' => 'Країна',
            'photo_200_orig' => 'Фото',
            'domain' => 'Домен',
            'school_id' => 'ID школи',
            'school_city_id' => 'ID міста школи',
            'school_name' => 'Назва школи',
            'school_year_to' => 'Рік закінчення',
            'last_seen' => 'Заходив останній раз',
            'can_post' => 'Чи можна лишати пости',
            'can_write_private_message' => 'Чи можна приватні повідомлення',
            'description' => 'Короткий опис',
            'active' => 'Активно',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
        ];
    }

    /**
     * @inheritdoc
     * @return VkUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VkUserQuery(get_called_class());
    }
}
