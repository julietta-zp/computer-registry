<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application`.
 */
class m161129_101911_create_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'app_name' => $this->string(64)->notNull()->unique(),
            'vendor_name' => $this->string(64)->notNull(),
            'license_required' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('application');
    }
}
