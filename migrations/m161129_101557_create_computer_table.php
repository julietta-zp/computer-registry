<?php

use yii\db\Migration;

/**
 * Handles the creation of table `computer`.
 */
class m161129_101557_create_computer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('computer', [
            'id' => $this->primaryKey(),
            'computer_name' => $this->string(64)->notNull()->unique(),
            'ip_address' => $this->string(64)->notNull(),
            'login' => $this->string(64)->notNull(),
            'password' => $this->text()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('computer');
    }
}
