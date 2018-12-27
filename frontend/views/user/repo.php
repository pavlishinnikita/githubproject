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
    <?for ($i = 0; $i < 50; $i++):?> <!-- пока так, а потом что-то придумаю -->
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="repo-list-item" data-id = "<?=$answer[$i]['id']?>">
            <?= Html::a($answer[$i]['full_name'], Url::to([
                    '/user/description',
                    'repo_name' => $answer[$i]['full_name'],
                    'repo_id' => $answer[$i]['id']
            ]))?>
            <?foreach ($user_like as $like):?>
                <?php $isLike = false; ?>
                    <?if($like->id_repo == $answer[$i]['id']):?>
<!--                        <div class="glyphicon glyphicon-thumbs-up repo-like"></div>-->
                        <i class="glyphicon glyphicon-thumbs-down repo-dislike"></i>
                        <?php $isLike = true; ?>
                    <?break;?>
                    <?endif;?>
                <?endforeach;?>
            <?if(!$isLike):?>
                <i class="glyphicon glyphicon-thumbs-up repo-like"></i>
            <?endif;?>
<!--                --><?//if($user_like[$i]->id_repo != $answer[$i]['id']):?>
<!--                    <div class="glyphicon glyphicon-thumbs-up repo-like"></div>-->
<!--                --><?//else:?>
<!--                    <div class="glyphicon glyphicon-thumbs-down repo-dislike"></div>-->
<!--                --><?//endif;?>
        </div>
    </div>
    <?endfor;?> <!-- пока так, а потом что-то придумаю -->
</div>
<div class="content-navigate row">
    <div class="col-lg-12 col-xs-12 col-md-12">
        <?= Html::a('Следующие репозитории', Url::to([
            '/user/repo',
            'since' => $answer[count($answer) - 1]['id'],
        ]))?>
    </div>
</div>
