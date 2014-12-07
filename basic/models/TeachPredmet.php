<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teach_predmet".
 *
 * @property integer $id
 * @property integer $teach_id
 * @property integer $predmet_id
 */
class TeachPredmet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teach_predmet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teach_id', 'predmet_id'], 'required'],
            [['teach_id', 'predmet_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teach_id' => 'Номер викладача',
            'predmet_id' => 'Номер предмета',
        ];
    }
}
