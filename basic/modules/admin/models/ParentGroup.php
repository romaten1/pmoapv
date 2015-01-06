<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "parent_group".
 *
 * @property integer $id
 * @property string $title
 */
class ParentGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parent_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва батьківської категорії статичної сторінки',
        ];
    }
}
