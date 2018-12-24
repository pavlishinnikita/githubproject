<?php

use yii\db\Migration;

/**
 * Class m181223_194350_alter_user_repo_like_table_like_field_change
 */
class m181223_194350_alter_user_repo_like_table_like_field_change extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user_repo_like', 'like', \yii\db\Schema::TYPE_BOOLEAN);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181223_194350_alter_user_repo_like_table_like_field_change cannot be reverted.\n";

        return false;
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181223_194350_alter_user_repo_like_table_like_field_change cannot be reverted.\n";

        return false;
    }
    */
}
