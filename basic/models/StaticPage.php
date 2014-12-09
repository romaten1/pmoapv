<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $text
 * @property integer $active
 * @property integer $parent_group_id
 */
class StaticPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'text', 'active', 'parent_group_id'], 'required'],
            [['text'], 'string'],
            [['alias'], 'unique'],
            [['active', 'parent_group_id'], 'integer'],
            [['alias'], 'string', 'max' => 100],
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
            'alias' => 'Аліас сторінки',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'active' => 'Активно чи ні',
            'parent_group_id' => 'Код групи',
        ];
    }
}
