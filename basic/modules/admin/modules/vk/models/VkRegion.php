<?php

namespace app\modules\admin\modules\vk\models;

use Yii;

/**
 * This is the model class for table "vk_region".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $title
 */
class VkRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'required'],
            [['region_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'title' => 'Title',
        ];
    }
}
