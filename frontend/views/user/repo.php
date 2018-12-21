<?php
/**
 * @var $this yii\web\View
 * @var $answer mixed
 * @var $repo_like UserRepoLike
 *
 */

use frontend\models\UserRepoLike;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h1 class="content-title">Репозитории</h1>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-md-12">
        <div class="search-bar">
            <form method="get" id="search-form">
                <label for="repoName">Название репозитория</label>
                <input type="text" id="repoName">
                <div id="bth-search" class="btn btn-info">Го <i class="glyphicon glyphicon-search"></i> </div>
<!--                <input type="submit" value="Го :)">-->
            </form>
        </div>
    </div>
</div>
<div class="glyphicon glyphicon-thumbs-up"></div>
<div class="glyphicon glyphicon-thumbs-down"></div>
<div class="content-container row">
    <?for ($i = 0; $i < 50; $i++):?>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="repo-list-item">
            <a href="/user/test?a=<?=$answer[$i]['full_name']?>"><?=$answer[$i]['name']?></a>
        </div>
    </div>
    <?endfor;?>
</div>
