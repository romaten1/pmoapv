<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property string $user
 * @property string $request
 * @property integer $time
 * @property string $ip
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'request', 'time', 'ip'], 'required'],
            [['request'], 'string'],
            [['time'], 'integer'],
            [['user'], 'string', 'max' => 100],
            [['ip'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'request' => 'Request',
            'time' => 'Time',
            'ip' => 'Ip',
        ];
    }
}
