<?php

use yii\db\Migration;

/**
 * Class m180622_195209_create_row_like_comment
 */
class m180622_194401_create_row_approved_comment extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'approved', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'approved');
    }
}
