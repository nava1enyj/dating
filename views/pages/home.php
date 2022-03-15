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
        <h3>Фильтры</h3>
        <hr>
        <div class="container">
            <form class="row g-3" method="get">
                <h5>Возраст</h5>
                <div class="col-md-1 mt-0">
                    <label for="val1" class="form-label">От</label>
                    <input type="text" name="fromAge" class="form-control" id="val1" value="18" placeholder="18" required>
                </div>
                <div class="col-md-1 mt-0">
                    <label for="val2" class="form-label">До</label>
                    <input type="text" name="toAge" class="form-control" id="val2" value="24" placeholder="24" required>
                </div>

                <h5>Пол</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radio"  id="inlineRadio1" value="Мужчина" checked>
                    <label class="form-check-label" for="inlineRadio1">Мужчина</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="Женщина">
                    <label class="form-check-label" for="inlineRadio2">Женщина</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="radio"  id="inlineRadio3" value="Небинарный">
                    <label class="form-check-label" for="inlineRadio3">Небинарный</label>
                </div>
                <br><button type="submit" name="btn-sig" class="btn btn-info mt-3">Применить</button>
            </form>
        </div>
        <h3 class="mt-5">Анкеты</h3>
        <hr>
        <?php
        if(isset($_GET['btn-sig'])){
            $fromAge = $_GET['fromAge'];
            $toAge = $_GET['toAge'];
            $r = $_GET['radio'];
            echo $r;

            $users = R::getAll("SELECT `id` FROM `users` WHERE `pol` = ? AND `age` > ? AND `age` < ?", [$r,$fromAge,$toAge]);

            foreach ($users as $user) {
                $questionnaires = R::findAll('questionnaire', 'iduser = ?' ,[$user['id']] );
                foreach ($questionnaires as $questionnaire){
                    $user = \R::findOne('users', 'id = ?', [$questionnaire->iduser]);
                    ?>
                    <h5>Имя: <?= $user->name ?></h5>
                    <h5>Фамилия: <?= $user->lastname ?></h5>
                    <img src="<?= $user->avatar ?>" class="img-thumbnail img-max-width mb-3" alt="...">
                    <p>Дата: <?= $user->date ?></p>
                    <p>Пол: <?= $user->pol ?></p>
                    <p class="text-break">Обо мне: <?= $questionnaire->about ?></p>
                    <p>Хобби: <?= $questionnaire->hobby ?></p>
                    <p>Кого ищу: <?= $questionnaire->search ?></p>
                    <a class="link link-primary" href="/chat/<?= $user->id ?>">Написать....</a>
                    <hr>
                    <?php
                }
            }
            //R::genSlots($users);





            die();
        }

        $questionnaires = R::findAll('questionnaire', 'ORDER BY id DESC');
        foreach ($questionnaires as $questionnaire) {
            $user = \R::findOne('users', 'id = ?', [$questionnaire->iduser]);
        ?>
            <h5>Имя: <?= $user->name ?></h5>
            <h5>Фамилия: <?= $user->lastname ?></h5>
            <img src="<?= $user->avatar ?>" class="img-thumbnail img-max-width mb-3" alt="...">
            <p>Дата: <?= $user->date ?></p>
            <p>Пол: <?= $user->pol ?></p>
            <p class="text-break">Обо мне: <?= $questionnaire->about ?></p>
            <p>Хобби: <?= $questionnaire->hobby ?></p>
            <p>Кого ищу: <?= $questionnaire->search ?></p>
            <a class="link link-primary" href="/chat/<?= $user->id ?>">Написать....</a>
            <hr>
        <?php
        }
        ?>
    </div>
</body>

</html>