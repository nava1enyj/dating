<?php
use App\Services\Page;
use App\Services\Router;

if(!$_SESSION['user']){
    \App\Services\Router::redirect('/login');
}
if($_SESSION['user']['id']===$_SESSION['query']){
    \App\Services\Router::redirect('/');
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
    <?php

    $user = \R::findOne('users', 'id = ?', [$_SESSION['query']]);

    ?>

    <p class="fs-4">Имя пользователя: <?= $user->name ?></p>
    <hr>
    <?php

    $showMessagesFrom = \R::findAll('messages', 'id_user_from = ? AND id_user_to = ? ORDER BY `messages`.`date` ASC', [$_SESSION['user']['id'] , $_SESSION['query']]);
    $showMessagesTo = \R::findAll('messages', 'id_user_from = ? AND id_user_to = ? ORDER BY `messages`.`date` ASC', [$_SESSION['query'] , $_SESSION['user']['id']]);



    ?>

    <div class="container mb-5">

        <form method="post">
            <p class="mb-3">Написать письмо:</p>
            <textarea class="input-group mb-3" name="message" ></textarea>
            <button name="btn-send-message" class="btn btn-primary">Отвправить</button>
        </form>
        <?php

        if(isset($_POST['btn-send-message'])){
            $message = $_POST['message'];
            if($message === ''){
                ?>
                <p class="text-danger">Поле не заполнено</p>
                <?php
                die();
            }


            $messages = \R::dispense('messages');
            $messages->idUserFrom = $_SESSION['user']['id'];
            $messages->idUserTo = $user->id;
            $messages->message = $message;
            \R::store($messages);
            Router::redirect('successabout');
        }

        ?>
    </div>

</div>


</body>
</html>