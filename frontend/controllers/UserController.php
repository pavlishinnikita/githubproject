<?php

namespace frontend\controllers;
use frontend\models\UserRepoLike;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use common\models\GitHubHelper;

class UserController extends \yii\web\Controller
{
    public function actionRepo()
    {
        //        var_dump(\Yii::$app->user->identity->getId());
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
                ->setData(['q' => $repo_name]) // repo name
                ->send();
        } catch (Exception $e) {
            new \yii\base\Exception('ошибка запроса');
        }

        if (!$response->isOk) {
            new \yii\base\Exception('ошибка запроса');
        }
        return $this->renderAjax('_search-repo', [
            'answer' => $response->data['items']
        ]);
//        return $this->render('repo', [
//            'answer' => $response->data
//        ]);
    }
}
