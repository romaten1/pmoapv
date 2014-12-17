<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "teach_metodychky".
 *
 * @property integer $id
 * @property integer $teach_id
 * @property integer $metodychky_id
 */
class TeachMetodychky extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teach_metodychky';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teach_id', 'metodychky_id'], 'required'],
            [['teach_id', 'metodychky_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teach_id' => 'Викладач',
            'metodychky_id' => 'Методичні вказівки',
        ];
    }
}
