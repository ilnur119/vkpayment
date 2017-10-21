<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171020_171055_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'application_id' => $this->integer()->notNull(),
            'vk_product_id' => $this->bigInteger(),
            'title' => $this->string(),
            'description' => $this->text(),
            'currency' => $this->string(),
            'price' => $this->decimal(19, 2),
            'thumb_photo' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-product-application_id', 'product', 'application_id');
        $this->addForeignKey('fk-product-application_id', 'product', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-product-application_id','product');
        $this->dropForeignKey('fk-product-application_id', 'product');
        $this->dropTable('product');
    }
}
