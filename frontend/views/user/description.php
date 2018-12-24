<?php
/**
 * @var $this \yii\web\View
 * @var $like string
 * @var $dislike string
 * @var $answer mixed
 */

$this->title = 'Описание репозитория';
?>
<h1 class="content-title"><?=$answer['items'][0]['full_name']?></h1>
<div class="content-container">
    <div class="author">Автор: <?=$answer['items'][0]['owner']['login']?></div>
    <div class="author-url">Ссылка на автора: <?=$answer['items'][0]['owner']['url']?></div>
    <div>Лайков: <?=$like?></div>
    <div>Дизлайков: <?=$dislike?></div>
</div>

