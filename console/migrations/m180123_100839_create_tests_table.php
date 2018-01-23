<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tests`.
 */
class m180123_100839_create_tests_table extends Migration
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

        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey(),
            'name_tests' => $this->string()->notNull()->unique(),
            'time_passing' => $this->integer()->notNull(),
            'number_passing' => $this->integer()->notNull(),
            'avarage_score' => $this->integer()->notNull(),
            'created_at' =>$this->float()->notNull(),

        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%tests}}');
    }
}
