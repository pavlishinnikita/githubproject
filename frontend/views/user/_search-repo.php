<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 21.12.2018
 * Time: 23:36
 * @var $answer mixed
 * @var $user_like UserRepoLike[]
 *
 */

use frontend\models\UserRepoLike;

?>
<?for ($i = 0; $i < 50; $i++):?>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="repo-list-item">
            <?= ($i + 1) . '(' . $answer[$i]['id'] . ') ' . ': '?> <!-- debug line -->
            <a href="/user/test?a=<?=$answer[$i]['full_name']?>"><?=$answer[$i]['full_name']?></a>
            <?if ($i != count($user_like)):?>
                <?if($user_like[$i]->id_repo != $answer[$i]['id']):?>
                    <div class="glyphicon glyphicon-thumbs-up repo-like"></div>
                <?else:?>
                    <div class="glyphicon glyphicon-thumbs-down repo-dislike"></div>
                <?endif;?>
            <?endif;?>
        </div>
    </div>
<?endfor;?>
<?//for ($i = 0; $i < count($answer); $i++):?>
<!--    <div class="col-lg-12 col-md-12 col-xs-12">-->
<!--        <div class="repo-list-item">-->
<!--            --><?//= ($i + 1) . ': '?>
<!--            <a href="/user/test?a=--><?//=$answer[$i]['full_name']?><!--">--><?//=$answer[$i]['full_name']?><!--</a>-->
<!--        </div>-->
<!--    </div>-->
<?//endfor;?>