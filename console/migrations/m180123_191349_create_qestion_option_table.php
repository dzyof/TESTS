<?php

use yii\db\Migration;

/**
 * Handles the creation of table `qestion_option`.
 */
class m180123_191349_create_qestion_option_table extends Migration
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
        $this->createTable('{{%qestion_option}}', [
            'id' => $this->primaryKey(),
            'qestion_id' => $this->integer()->notNull(),
            'option_text' =>  $this->string()->notNull(),
            'correct_option' => $this->boolean()
        ],$tableOptions);

        $this->addForeignKey('qestion_options', 'qestion_option','qestion_id','qestion','id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'qestion_options',
            'qestion_option'
        );

        $this->dropTable('{{%qestion_option}}');



    }
}
