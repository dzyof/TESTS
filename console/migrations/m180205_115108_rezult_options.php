<?php

use yii\db\Migration;

/**
 * Class m180205_115108_rezult_options
 */
class m180205_115108_rezult_options extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci

        }

        $this->createTable('{{%rezults_option}}', [
            'id' => $this->primaryKey(),
            'rezult_id' => $this->integer()->notNull(),
            'question' =>   $this->string()->notNull(),
            'questions_answer' => $this->string()->notNull(),
            'right_answer' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('option_rez', 'rezults_option', 'rezult_id', 'rezults', 'id');
    }

    public function down()
    {
        $this->dropForeignKey(
            'option_rez',
            'rezults_option'
        );
        $this->dropTable('{{%rezults_option}}');
    }
}
