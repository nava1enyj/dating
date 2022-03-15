<?php
use App\Services\Page;
use App\Services\Router;

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
    <?php

    $user = \R::findOne('users', 'id = ?', [$_SESSION['query']]);

    ?>

    <p class="fs-4">Имя пользователя: <?= $user->name ?></p>
    <hr>
    <?php

    $showMessages = \R::findAll('messages', 'id_user_from = ? AND id_user_to = ? ORDER BY `messages`.`date` ASC', [$_SESSION['user']['id'] , $_SESSION['query']]);
    foreach ($showMessages as $showMessage){

        if($showMessage->id_user_from){
            ?>
            <p class="text-end"><?= $showMessage->message;?></p>
            <?php
        }
        else{
            ?>
            <p class=""><?= $showMessage->message;?></p>
            <?php
        }
        ?>

    <?php
    }
    ?>
    <div class="fixed-bottom container mb-5">

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
            Router::redirect('chat/' . $user->id);
        }

        ?>
    </div>

</div>


</body>
</html>