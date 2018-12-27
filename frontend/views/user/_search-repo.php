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
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?for ($i = 0; $i < 50; $i++):?>
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