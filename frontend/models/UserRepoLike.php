<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_repo_like".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_repo
 * @property int $like
 */
class UserRepoLike extends \yii\db\ActiveRecord
{
    /**
     * Constant for identify like: 0 - nothing, 1 - like, 2 - dislike
     */
    const NOTHING = 0;
    const LIKE = 1;
    const DISLIKE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_repo_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_repo'], 'required'],
            [['id_user', 'id_repo', 'like'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_repo' => 'Id Repo',
            'like' => 'Like',
        ];
    }
}