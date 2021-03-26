<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skills}}`.
 */
class m210301_153436_create_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'category_id' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx_skills_users',
            'skills',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-skills_users',
            'skills',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_skills_categories',
            'skills',
            'category_id'
        );

        // add foreign key for table `categories`
        $this->addForeignKey(
            'fk-skills_categories',
            'skills',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-skills_users',
            'skills'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx_skills_users',
            'skills'
        );

        // drops foreign key for table `categories`
        $this->dropForeignKey(
            'fk-skills_categories',
            'skills'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx_skills_categories',
            'skills'
        );

        $this->dropTable('{{%skills}}');
    }
}
