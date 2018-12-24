<?php

namespace frontend\controllers;
use frontend\models\UserRepoLike;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use common\models\GitHubHelper;

class UserController extends \yii\web\Controller
{
    public function actionRepo()
    {
        $user_like = UserRepoLike::find()
            ->where(['id_user' => \Yii::$app->user->identity->getId() ])
            ->all();
        $client = new Client();
        try {
            $response = $client->createRequest()
                ->setMethod('get')
                ->setHeaders(['content-type' => GitHubHelper::CONTENT_TYPE ])
                ->addHeaders(['user-Agent' => GitHubHelper::USER_AGENT ])
                ->setUrl([ GitHubHelper::URL ])
                ->setData(['since' => 0]) // last remember repo
                ->send();
        } catch (Exception $e) {
            new \yii\base\Exception('ошибка запроса');
        }

        if (!$response->isOk) {
            new \yii\base\Exception('ошибка запроса');
        }
        return $this->render('repo', [
            'answer' => $response->data,
            'user_like' => $user_like
        ]);
    }

    public function actionSearch()
    {
        $repo_name = \Yii::$app->request->get('repoName');
        $client = new Client();
        try {
            $response = $client->createRequest()
                ->setMethod('get')
                ->setHeaders(['content-type' => GitHubHelper::CONTENT_TYPE ])
                ->addHeaders(['user-Agent' => GitHubHelper::USER_AGENT ])
                ->setUrl([ GitHubHelper::URL_SEARCH])
                ->setData(['q' => $repo_name, 'per_page' => 50]) // repo name and repo count
                ->send();
        } catch (Exception $e) {
            new \yii\base\Exception('ошибка запроса');
        }

        if (!$response->isOk) {
            // обработка ошибки
        }
        return $this->renderAjax('_search-repo', [
            'answer' => $response->data['items']
        ]);
//        return $this->render('repo', [
//            'answer' => $response->data
//        ]);
    }

    public function actionDescription($repo_name, $repo_id)
    {
        $client = new Client();
        try {
            $response = $client->createRequest()
                ->setMethod('get')
                ->setHeaders(['content-type' => GitHubHelper::CONTENT_TYPE ])
                ->addHeaders(['user-Agent' => GitHubHelper::USER_AGENT ])
                ->setUrl([ GitHubHelper::URL_SEARCH])
                ->setData(['q' => $repo_name])
                ->send();
        } catch (Exception $e) {
            // обработка ошибки
        } catch (InvalidConfigException $e) {
            // обработка ошибки составления запроса
        }

        if (!$response->isOk) {
//             запрос не выполнился
        }
        $like = ( new Query() )
            ->select(['id'])
            ->from('user_repo_like')
            ->where(['id_repo' => $repo_id])
            ->andWhere(['like' => UserRepoLike::LIKE])
            ->count();
        $dislike = ( new Query() )
            ->select(['id'])
            ->from('user_repo_like')
            ->where(['id_repo' => $repo_id])
            ->andWhere(['like' => UserRepoLike::DISLIKE])
            ->count();
//        var_dump($response->data);
        return $this->render('description', [
            'answer' => $response->data,
            'like' => $like,
            'dislike' => $dislike
        ]);
    }

    public function actionLike()
    {
        $id_repo = \Yii::$app->request->post('repo_id');
        $like_dislike = UserRepoLike::findOne(['id_repo' => $id_repo]);
        if($like_dislike == NULL) {
            // лайка не было
            $model = new UserRepoLike();
            $model->id_user = \Yii::$app->user->identity->getId();
            $model->id_repo = $id_repo;
            $model->like = UserRepoLike::LIKE;
            if($model->save()) {
                return $this->renderAjax('_dislike');
            } else {
                return "Ошибка сервера";
            }
        } else {
            // лайк был
            $like_dislike->like = UserRepoLike::DISLIKE;
            if($like_dislike->save()) {
                return $this->renderAjax('_like');
            } else {
                return "Ошибка сервера";
            }
        }
//        var_dump(json_encode($like_dislike));
//        die();
    }
}
