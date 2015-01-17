<?php

namespace app\models\query;

use yii\db\ActiveQuery;
use Yii;

/**
 * Class MessageQuery
 */
class MessageQuery extends ActiveQuery
{
    /**
     * Select received messages.
     *
     * @return $this
     */
    public function received_messages()
    {
        $this->andWhere(['receiver_id' => Yii::$app->user->id]);
        return $this;
    }

    /**
     * Select own messages.
     *
     * @return $this
     */
    public function own_messages()
    {
        $this->andWhere(['author_id' => Yii::$app->user->id]);
        return $this;
    }

}
