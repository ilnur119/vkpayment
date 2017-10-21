<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m171020_173003_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'application_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'address' => $this->text()->notNull(),
            'quantity' => $this->integer(),
            'status' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-order-application_id', 'order', 'application_id');
        $this->createIndex('idx-order-customer_id', 'order', 'customer_id');
        $this->addForeignKey('fk-order-application_id', 'order', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-order-customer_id', 'order', 'customer_id',
            'application', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-order-application_id','order');
        $this->dropIndex('idx-order-customer_id','order');
        $this->dropForeignKey('fk-order-application_id', 'order');
        $this->dropForeignKey('fk-order-customer_id', 'order');
        $this->dropTable('order');
    }
}
