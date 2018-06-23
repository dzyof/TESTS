<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180620_191212_create_comment_table extends Migration
{


    public function up()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text'=>$this->string(),
            'user_id'=>$this->integer(),
            'article_id'=>$this->integer(),
            'comment_id'=>$this->integer(),
            'status'=>$this->integer()
        ]);

    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%comment}}');
    }

}
