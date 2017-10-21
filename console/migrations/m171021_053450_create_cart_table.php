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
            'product_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('cart_pk', 'cart', ['product_id', 'order_id']);

        $this->createIndex('idx-cart-product_id', 'cart', 'product_id');
        $this->createIndex('idx-cart-order_id', 'cart', 'order_id');

        $this->addForeignKey('fk-cart-product_id', 'cart', 'product_id',
            'product', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-cart-order_id', 'cart', 'order_id',
            'order', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-cart-product_id','cart');
        $this->dropIndex('idx-cart-order_id','cart');
        $this->dropForeignKey('fk-cart-product_id', 'cart');
        $this->dropForeignKey('fk-cart-order_id', 'cart');
        $this->dropTable('cart');
    }
}
