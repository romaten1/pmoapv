<?php

namespace app\modules\admin\modules\vk\models;

use Yii;

/**
 * This is the model class for table "vk_city".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $title
 * @property string $area
 * @property string $region
 */
class VkCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'required'],
            [['city_id'], 'integer'],
            [['title', 'area', 'region'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'title' => 'Title',
            'area' => 'Area',
            'region' => 'Region',
        ];
    }
}
