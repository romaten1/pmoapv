<?php

namespace app\modules\customer\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "customer_order".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $posted_at
 * @property integer $amount
 * @property integer $paid_at
 *
 * @property Customer $customer
 */
class CustomerOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'posted_at', 'amount', 'paid_at'], 'required'],
            [['customer_id', 'amount'], 'integer'],
            [['posted_at', 'paid_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Покупатель',
            'posted_at' => 'Размещенно',
            'amount' => 'Количество',
            'paid_at' => 'Оплачено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    /**
     * Переводим дату в Timestamp перед сохранением
     */
    public function beforeSave($insert)
    {
        $posted_at = new DateTime($this->posted_at);
        $paid_at = new DateTime($this->paid_at);
        $this->posted_at = $posted_at->getTimestamp();
        $this->paid_at = $paid_at->getTimestamp();
        return parent::beforeSave($insert);
    }

}
