<?php

use yii\db\Migration;

/**
 * Handles the creation of table `qestion`.
 */
class m180123_191055_create_qestion_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci

        }

        $this->createTable('{{%qestion}}', [
            'id' => $this->primaryKey(),
            'tests_id'=> $this->integer()->notNull(),
            'text_qestion' => $this->string()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('qestion_tests', 'qestion', 'tests_id', 'tests', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'qestion_tests',
            'qestion'
        );

        $this->dropTable('{{%qestion}}');
    }
}
