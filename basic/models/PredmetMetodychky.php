<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "predmet_metodychky".
 *
 * @property integer $id
 * @property integer $predmet_id
 * @property integer $metodychky_id
 */
class PredmetMetodychky extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'predmet_metodychky';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['predmet_id', 'metodychky_id'], 'required'],
            [['predmet_id', 'metodychky_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'predmet_id' => 'Предмет',
            'metodychky_id' => 'Методичні вказівки',
        ];
    }
}
