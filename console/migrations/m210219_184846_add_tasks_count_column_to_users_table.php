<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m210219_184846_add_tasks_count_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'tasks_count', $this->integer()->unsigned()->notNull()->defaultValue(0));
	$this->addCommentOnColumn('{{%users}}', 'tasks_count','Количество выполненных заданий');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'tasks_count');
    }
}
