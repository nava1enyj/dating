<?php
use App\Services\Page;

if(!$_SESSION['user']){
    \App\Services\Router::redirect('/login');
}
?>
<html>
<?php
Page::par('head');
?>
<body>
<?php
Page::par('navbar');
?>
<div class="container-xxl">
    <h3>Личный кабинет</h3>
    <hr>
    <h5>Имя: <?= $_SESSION['user']['name'] ?></h5>
    <h5>Фамилия: <?= $_SESSION['user']['lastname'] ?></h5>
    <img src="<?= $_SESSION['user']['avatar'] ?>" class="img-thumbnail img-max-width mb-3" alt="...">
    <h5> Дата рождения: <?= $_SESSION['user']['date'] ?></h5>
    <h5> Гендер: <?= $_SESSION['user']['pol'] ?></h5>
    <hr>
    <h3>Анкета</h3>
    <?php
    $user = \R::findOne('questionnaire' , 'iduser = ?', [$_SESSION['user']['id']]);
    ?>
    <div>Кого ищу: <?= $user->search ?></div>
    <div>Хобби: <?= $user->hobby ?></div>
    <div>Обо мне: <?= $user->about ?></div>
</div>


</body>
</html>