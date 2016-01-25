<?php

namespace app\modules\admin\modules\vk\models;

/**
 * This is the ActiveQuery class for [[VkUser]].
 *
 * @see VkUser
 */
class VkUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return VkUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VkUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}