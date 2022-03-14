<?php

use App\Services\Page;
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
        <h3>Сделай блок с фильтрами!@!!!!!!!!!!!!</h3>
       <h3>Все анкеты</h3>
        <hr>
        <?php
        $questionnaires = R::findAll( 'questionnaire' );
        foreach ($questionnaires as $questionnaire){
            $user = \R::findOne('users' , 'id = ?', [$questionnaire->iduser]);
            ?>
            <h5>Имя: <?= $user->name ?></h5>
            <h5>Фамилия: <?= $user->lastname ?></h5>
            <img src="<?= $user->avatar ?>" class="img-thumbnail img-max-width mb-3" alt="...">
            <p>Дата: <?= $user->date ?></p>
            <p>Пол: <?= $user->pol ?></p>
            <p class="text-break">Обо мне: <?= $questionnaire->about ?></p>
            <p>Хобби: <?= $questionnaire->hobby ?></p>
            <p>Кого ищу: <?= $questionnaire->search ?></p>
            <hr>
            <?php
        }
        ?>
    </div>

</body>

</html>