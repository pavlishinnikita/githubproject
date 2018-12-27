<?php

use yii\db\Migration;

/**
 * Class m181227_091113_addColumn_repo_nameInTableUser_repo_like
 */
class m181227_091113_addColumn_repo_nameInTableUser_repo_like extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_repo_like', 'repo_name', \yii\db\Schema::TYPE_STRING);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_repo_like', 'repo_name');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181227_091113_addColumn_repo_nameInTableUser_repo_like cannot be reverted.\n";

        return false;
    }
    */
}
