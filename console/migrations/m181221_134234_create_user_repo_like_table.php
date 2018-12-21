<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `user_repo_like`.
 */
class m181221_134234_create_user_repo_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_repo_like', [
            'id' => $this->primaryKey(),
            'id_user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'id_repo' => Schema::TYPE_INTEGER . ' NOT NULL',
            'like' => Schema::TYPE_SMALLINT
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_repo_like');
    }
}
