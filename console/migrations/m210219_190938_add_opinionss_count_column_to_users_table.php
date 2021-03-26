<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m210219_190938_add_opinionss_count_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'opinions_count', $this->integer()->unsigned()->notNull()->defaultValue(0));
	$this->addCommentOnColumn('{{%users}}', 'opinions_count','Количество отзывов');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'opinions_count');
    }
}
