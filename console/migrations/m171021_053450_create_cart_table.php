<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m171021_053450_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'application_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('cart_pk', 'cart', ['application_id', 'order_id']);

        $this->createIndex('idx-cart-application_id', 'cart', 'application_id');
        $this->createIndex('idx-cart-order_id', 'cart', 'order_id');
        $this->addForeignKey('fk-cart-application_id', 'cart', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-cart-order_id', 'cart', 'order_id',
            'application', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-cart-application_id','cart');
        $this->dropIndex('idx-cart-order_id','cart');
        $this->dropForeignKey('fk-cart-application_id', 'cart');
        $this->dropForeignKey('fk-cart-order_id', 'cart');
        $this->dropTable('cart');
    }
}
