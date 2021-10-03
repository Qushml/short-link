<?php

use yii\db\Migration;

/**
 * Class m210928_203811_test
 */
class m210928_203811_base_table extends Migration
{
    protected string $tableName = '{{%link}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'url' => $this->text()->notNull(),
            'hash' => $this->string()->notNull(),
            'click_count' => $this->integer()->defaultValue(0)
        ]);

        $this->createIndex('idx-link-hash', $this->tableName, 'hash', true);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
