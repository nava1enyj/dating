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
            <form class="row g-3">
                <h5>Возраст</h5>
                <div class="col-md-1 mt-0">
                    <label for="val1" class="form-label">От</label>
                    <input type="text" class="form-control" id="val1" value="" placeholder="18" required>
                </div>
                <div class="col-md-1 mt-0">
                    <label for="val2" class="form-label">До</label>
                    <input type="text" class="form-control" id="val2" value="" placeholder="24" required>
                </div>
            </form>
            <form>
                <h5>Пол</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Мужчина</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Женщина</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">Небинарный</label>
                </div>
                <br><button type="submit" class="btn btn-info mt-3">Применить</button>
            </form>
        </div>
        <h3 class="mt-5">Анкеты</h3>
        <hr>
        <?php
        $questionnaires = R::findAll('questionnaire');
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