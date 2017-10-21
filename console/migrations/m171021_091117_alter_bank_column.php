<?php

use yii\db\Migration;

class m171021_091117_alter_bank_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('bank', 'account', $this->string()->notNull()->after('inn'));
    }

    public function safeDown()
    {
        $this->dropColumn('bank', 'account');
    }
}
