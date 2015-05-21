<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "student_group".
 *
 * @property integer $id
 * @property string $title
 * @property integer $specialnost
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $active
 */
class StudentGroup extends Root
{
    const SPEC_MECH_BAK = 0; // Механіки бакалаври
    const SPEC_MECH_SPEC = 1; // Механіки спеціалісти
    const SPEC_MECH_MAG = 2; // Механіки магістри

    public static function getSpecialnostArray()
    {
        return [
            self::SPEC_MECH_BAK => 'Бакалаври - Процеси, машини та обладнання АПВ',
            self::SPEC_MECH_SPEC => 'Спеціалісти - Процеси, машини та обладнання АПВ',
            self::SPEC_MECH_MAG => 'Магстри - Процеси, машини та обладнання АПВ',
        ];
    }

    public function getSpecialnostLabel()
    {
        $statuses = $this->getSpecialnostArray();
        return $statuses[$this->specialnost];
    }

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
        return 'student_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'specialnost', 'active'], 'required'],
            [['specialnost', 'created_at', 'updated_at', 'active'], 'integer'],
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
            'title' => 'Назва',
            'specialnost' => 'Спеціальність',
            'created_at' => 'Створено',
            'updated_at' => 'Оновлено',
            'active' => 'Активно',
        ];
    }
}
