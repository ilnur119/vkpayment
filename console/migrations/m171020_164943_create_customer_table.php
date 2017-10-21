<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m171020_164943_create_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'vk_user_id' => $this->bigInteger(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'inn' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('customer');
    }
}
