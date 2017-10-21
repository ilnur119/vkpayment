<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application_customer`.
 */
class m171020_165920_create_application_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application_customer', [
            'application_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('application_customer_pk', 'application_customer', ['application_id', 'customer_id']);

        $this->createIndex('idx-application_customer-application_id', 'application_customer', 'application_id');
        $this->createIndex('idx-application_customer-customer_id', 'application_customer', 'customer_id');
        $this->addForeignKey('fk-application_customer-application_id', 'application_customer', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-application_customer-customer_id', 'application_customer', 'customer_id',
            'customer', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-application_customer-application_id','application_customer');
        $this->dropIndex('idx-application_customer-customer_id','application_customer');
        $this->dropForeignKey('fk-application_customer-application_id', 'application_customer');
        $this->dropForeignKey('fk-application_customer-customer_id', 'application_customer');
        $this->dropTable('application_customer');
    }
}
