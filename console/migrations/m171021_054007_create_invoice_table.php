<?php

use yii\db\Migration;

/**
 * Handles the creation of table `invoice`.
 */
class m171021_054007_create_invoice_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('invoice', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'is_paid' => $this->boolean()->defaultValue(false),
            'bank_name' => $this->string()->notNull(),
            'bank_address' => $this->string()->notNull(),
            'bic' => $this->string(),
            'corr_invoice' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-invoice-order_id', 'invoice', 'order_id');
        $this->addForeignKey('fk-invoice-order_id', 'invoice', 'order_id',
            'order', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-invoice-order_id','invoice');
        $this->dropForeignKey('fk-invoice-order_id', 'invoice');
        $this->dropTable('invoice');
    }
}
