<?php

use yii\db\Migration;

/**
 * Class m180622_194401_create_row_like_comment
 */
class m180622_194401_create_row_imageFile_comment extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'imagename', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'imagename');
    }
}
