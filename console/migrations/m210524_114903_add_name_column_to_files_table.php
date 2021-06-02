<?php

use phpDocumentor\Reflection\Types\Null_;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%files}}`.
 */
class m210524_114903_add_name_column_to_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%files}}', 'name', $this->string(70)->defaultValue(NULL));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%files}}', 'name');
    }
}
