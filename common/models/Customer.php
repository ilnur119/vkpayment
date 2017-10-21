<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $vk_user_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $inn
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ApplicationCustomer[] $applicationCustomers
 * @property Application[] $applications
 * @property Order[] $orders
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
        return $this->hasMany(ApplicationCustomer::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['id' => 'application_id'])->viaTable('application_customer', ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    public static function findByVkId($vkId)
    {
        return static::findOne(['vk_user_id' => $vkId]);
    }
}
