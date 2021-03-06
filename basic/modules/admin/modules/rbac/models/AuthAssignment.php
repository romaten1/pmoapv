<?php

namespace app\modules\admin\modules\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class'      => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at' ],
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'item_name', 'user_id' ], 'required' ],
            [ [ 'created_at' ], 'integer' ],
            [ [ 'item_name', 'user_id' ], 'string', 'max' => 64 ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name'  => 'Назва ролі',
            'user_id'    => 'User ID',
            'created_at' => 'Створено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne( AuthItem::className(), [ 'name' => 'item_name' ] );
    }
}
