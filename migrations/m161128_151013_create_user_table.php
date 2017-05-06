<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161128_151013_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64)->notNull()->unique(),
            'first_name' => $this->string(64)->notNull(),
            'last_name' => $this->string(64)->notNull(),
            'password' => $this->text()->notNull(),
            'role' => "enum('user', 'admin') NOT NULL DEFAULT 'user'",
            'created_at' => $this->timestamp(),
        ]);

        $this->insert('user', array(
            'id' => '1',
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'password' => \Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'role' => 'admin',
            'created_at'=>date('Y-m-d H:i:s'),
        ));

    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
