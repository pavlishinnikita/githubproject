<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 21.12.2018
 * Time: 23:36
 * $answer mixed
 */
?>
<?for ($i = 0; $i < count($answer); $i++):?>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="repo-list-item">
            <a href="/user/test?a=<?=$answer[$i]['full_name']?>"><?=$answer[$i]['name']?></a>
        </div>
    </div>
<?endfor;?>