<?php
/**
 * @var $this yii\web\View
 * @var $answer mixed
 * @var $user_like UserRepoLike[]
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
                <div id="bth-search" class="btn btn-info">Го <i class="glyphicon glyphicon-search"></i></div>
            </form>
        </div>
    </div>
</div>
<div class="content-container row">
    <?for ($i = 0; $i < 50; $i++):?>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="repo-list-item" data-id = "<?=$answer[$i]['id']?>">
            <a href="/user/description?repo_name=<?=$answer[$i]['full_name']?>&repo_id=<?=$answer[$i]['id']?>"><?=$answer[$i]['full_name']?></a>
<!--            <div class="glyphicon glyphicon-thumbs-down repo-like"></div>-->

                <?if($user_like[$i]->id_repo != $answer[$i]['id']):?>
                    <div class="glyphicon glyphicon-thumbs-up repo-like"></div>
                <?else:?>
                    <div class="glyphicon glyphicon-thumbs-down repo-dislike"></div>
                <?endif;?>

        </div>
    </div>
    <?endfor;?>
</div>
