<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\ParentGroup;
use app\behaviors\PurifierBehavior;
use yii\db\ActiveRecord;

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
class StaticPage extends ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            'purifierBehavior' => [
                'class' => PurifierBehavior::className(),
                'textAttributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['text'],
                ]
            ]
        ];
    }

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
            [['title'], 'string', 'max' => 255],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PASSIVE]],
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

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активно',
            self::STATUS_PASSIVE => 'Неактивно',

        ];
    }

    /**
     * @param $active
     * @return mixed
     */
    public static function getStatus($active)
    {
        $status = self::getStatusArray();
        return $status[$active];
    }

    /**
     * @return mixed
     */
    public function getStatusLabel()
    {
        $statuses = $this->getStatusArray();
        return ArrayHelper::getValue($statuses, $this->active);
    }

    /**
     * @return array
     */
    public static function getParentArray()
    {
        $group = ParentGroup::find()->asArray()->all();
        $parentArray = [];
        foreach ($group as $val) {
            $parentArray[$val['id']] = $val['title'];
        }
        return $parentArray;
    }

    /**
     * @return mixed
     */
    public function getParentLabel()
    {
        $parents = $this->getParentArray();
        return ArrayHelper::getValue($parents, $this->parent_group_id);
    }
}
