<?php

use yii\db\Migration;

/**
 * Handles the creation of table `computer_application`.
 * Has foreign keys to the tables:
 *
 * - `computer`
 * - `application`
 */
class m161130_123018_create_computer_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('computer_application', [
            'id' => $this->primaryKey(),
            'computer_id' => $this->integer()->notNull(),
            'application_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `computer_id`
        $this->createIndex(
            'idx-computer_application-computer_id',
            'computer_application',
            'computer_id'
        );

        // add foreign key for table `computer`
        $this->addForeignKey(
            'fk-computer_application-computer_id',
            'computer_application',
            'computer_id',
            'computer',
            'id',
            'CASCADE'
        );

        // creates index for column `application_id`
        $this->createIndex(
            'idx-computer_application-application_id',
            'computer_application',
            'application_id'
        );

        // add foreign key for table `application`
        $this->addForeignKey(
            'fk-computer_application-application_id',
            'computer_application',
            'application_id',
            'application',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `computer`
        $this->dropForeignKey(
            'fk-computer_application-computer_id',
            'computer_application'
        );

        // drops index for column `computer_id`
        $this->dropIndex(
            'idx-computer_application-computer_id',
            'computer_application'
        );

        // drops foreign key for table `application`
        $this->dropForeignKey(
            'fk-computer_application-application_id',
            'computer_application'
        );

        // drops index for column `application_id`
        $this->dropIndex(
            'idx-computer_application-application_id',
            'computer_application'
        );

        $this->dropTable('computer_application');
    }
}
