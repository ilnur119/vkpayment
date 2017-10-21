<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bank`.
 */
class m171020_164634_create_bank_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bank', [
            'id' => $this->primaryKey(),
            'application_id' => $this->integer()->notNull(),
            'inn' => $this->string()->notNull(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);


        $this->createIndex('idx-bank-application_id', 'user', 'application_id');
        $this->addForeignKey('fk-bank-application_id', 'bank', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-bank-application_id','bank');
        $this->dropForeignKey('fk-bank-application_id', 'bank');
        $this->dropTable('bank');
    }
}
