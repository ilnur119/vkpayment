<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171020_163511_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string(32)->notNull(),
            'application_id' => $this->integer()->notNull(),
            'vk_user_id' => $this->integer(),
            'role' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-user-application_id', 'user', 'application_id');
        $this->addForeignKey('fk-user-application_id', 'user', 'application_id',
            'application', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-user-application_id','user');
        $this->dropForeignKey('fk-user-application_id', 'user');
        $this->dropTable('user');
    }
}
