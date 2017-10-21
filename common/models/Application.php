<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property integer $vk_group_id
 * @property string $access_token
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ApplicationCustomer[] $applicationCustomers
 * @property Customer[] $customers
 * @property Bank[] $banks
 * @property Order[] $orders
 * @property Product[] $products
 * @property User[] $users
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationCustomers()
    {
        return $this->hasMany(ApplicationCustomer::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['id' => 'customer_id'])->viaTable('application_customer', ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanks()
    {
        return $this->hasMany(Bank::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['application_id' => 'id']);
    }
}
