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
    <h3>Полученные</h3>
    <hr>
    <?php
    $messages = \R::findAll('messages' , 'id_user_to = ? ORDER BY date DESC', [$_SESSION['user']['id']]);
    foreach ($messages as $message) {
        $user = \R::findOne('users' , 'id = ?', [$message->id_user_from]);
        ?>
        <p><?= $message->date ?></p>
        <p>Кому: <?= $user->name ?></p>
        <p><?= $message->message ?></p>
        <a href="/chat/<?= $user->id ?>" class="link-primary link">Ответить</a>
        <hr>

        <?php
    }
    ?>

</div>

</body>
</html>