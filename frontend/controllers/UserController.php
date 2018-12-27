<?php

namespace frontend\controllers;
use frontend\models\UserRepoLike;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use common\models\GitHubHelper;
use yii\web\HttpException;

define('OFFLINE_MODE', 1);
class UserController extends \yii\web\Controller
{
    public function actionRepo($since)
    {
        if(defined('OFFLINE_MODE')) {
            $client = new Client();
            $response = $client->createResponse();
            $response->setData(json_decode(file_get_contents('testRepos.json'), true));
            $user_like = UserRepoLike::find()
                ->where(['id_user' => \Yii::$app->user->identity->getId()])
                ->andWhere(['like' => UserRepoLike::LIKE])
                ->andWhere('id_repo >= ' . $response->data[0]['id']) // пробую выводить лайки только для
                // отображаемых репозиториев
                ->all();
            return $this->render('repo', [
                'answer' => $response->data,
                'user_like' => $user_like
            ]);
        } else {
            $user_like = UserRepoLike::find()
                ->where(['id_user' => \Yii::$app->user->identity->getId()])
                ->all();
            $client = new Client();
            try {
                $response = $client->createRequest()
                    ->setMethod('get')
                    ->setHeaders(['content-type' => GitHubHelper::CONTENT_TYPE])
                    ->addHeaders(['user-Agent' => GitHubHelper::USER_AGENT])
                    ->setUrl([GitHubHelper::URL])
                    ->setData(['since' => $since])// last remember repo
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
    }

    public function actionSearch()
    {
        $repo_name = \Yii::$app->request->get('repoName');
        $client = new Client();
        if(defined('OFFLINE_MODE')) {
            $response = $client->createResponse();
            $response->setData(json_decode(file_get_contents('testSearch.json'), true));
        } else {
            try {
                $response = $client->createRequest()
                    ->setMethod('get')
                    ->setHeaders(['content-type' => GitHubHelper::CONTENT_TYPE])
                    ->addHeaders(['user-Agent' => GitHubHelper::USER_AGENT])
                    ->setUrl([GitHubHelper::URL_SEARCH])
                    ->setData(['q' => $repo_name, 'per_page' => 50])// repo name and repo count
                    ->send();
            } catch (Exception $e) {
                new \yii\base\Exception('ошибка запроса');
            }
                if (!$response->isOk) {
                    throw new HttpException(501, "Ошибка сервера");
                }
        }
        $user_like = UserRepoLike::find()
            ->where(['id_user' => \Yii::$app->user->identity->getId()])
            ->andWhere(['like' => UserRepoLike::LIKE])
//            ->andWhere('id_repo >= ' . $response->data['items'][0]['id'])
            ->all();
        return $this->renderAjax('_search-repo', [
            'answer' => $response->data['items'],
            'user_like' => $user_like
        ]);
    }

    public function actionDescription($repo_name, $repo_id)
    {
        $isValidRepo = UserRepoLike::findOne(['id_repo' => $repo_id]);
        if($isValidRepo->repo_name != $repo_name) {
            throw new HttpException(400 ,'Строка браузера доступна только продвинутым пользователям');
        }
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
            throw new HttpException(501, "Ошибка сервера");
        }
        $like = UserRepoLike::find()
            ->where(['id_repo' => $repo_id])
            ->andWhere(['like' => UserRepoLike::LIKE])
            ->count();
        $dislike = UserRepoLike::find()
            ->where(['id_repo' => $repo_id])
            ->andWhere(['like' => UserRepoLike::DISLIKE])
            ->count();
        return $this->render('description', [
            'answer' => $response->data,
            'like' => $like,
            'dislike' => $dislike
        ]);
    }

    public function actionLike()
    {
        $id_repo = \Yii::$app->request->post('repo_id');
        $repo_name = \Yii::$app->request->post('repo_name');
        $like_dislike = UserRepoLike::find()
            ->where(['id_repo' => $id_repo])
            ->andWhere(['id_user' => \Yii::$app->user->identity->getId()])
            ->one();
        if($like_dislike == NULL) { // лайка не было и дизлайка не было
            $model = new UserRepoLike();
            $model->id_user = \Yii::$app->user->identity->getId();
            $model->id_repo = $id_repo;
            $model->like = UserRepoLike::LIKE;
            $model->repo_name = $repo_name;
            if($model->save()) {
                return 'glyphicon glyphicon-thumbs-down repo-dislike';
            }
        } else if($like_dislike->like == UserRepoLike::LIKE) {
            // лайк был
            $like_dislike->like = UserRepoLike::DISLIKE;
            if($like_dislike->save()) {
                return 'glyphicon glyphicon-thumbs-up repo-like';
            }
        } else {
            // дизлайк был
            $like_dislike->like = UserRepoLike::LIKE;
            if($like_dislike->save()) {
                return 'glyphicon glyphicon-thumbs-down repo-dislike';
            }
        }
        return "Ошибка сервера";
    }

    public function actionTest()
    {
        return $this->render('test');
    }
}
