<?php

namespace app\modules\customer\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $address
 *
 * @property CustomerOrder[] $customerOrders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address'], 'required'],
            [['name', 'phone'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerOrders()
    {
        return $this->hasMany(CustomerOrder::className(), ['customer_id' => 'id']);
    }

    public static function getCustomersArray()
    {
        $customers = self::find()->asArray()->all();
        $customers_result = [];
        foreach ($customers as $customer) {
            $customers_result[$customer['id']] = $customer['name'];
        }
        return $customers_result;
    }
}
