<?php

use yii\db\Migration;

/**
 * Class m180126_094701_rezults_table
 */
class m180126_094701_rezults_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%rezults}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'data_pass' =>  $this->dateTime(),
            'test_id' => $this->integer()->notNull(),
            'correct_unswer' => $this->integer()->notNull(),
            'wrong_unswer' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('rez_user', 'rezults', 'user_id', 'user', 'id');
        $this->addForeignKey('rez_test', 'rezults', 'test_id', 'tests', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'rez_user',
            'rezults'
        );
        $this->dropForeignKey(
            'rez_test',
            'rezults'
        );

        $this->dropTable('{{%rezults}}');
    }
}
