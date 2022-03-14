<?php
use App\Services\Page;
if($_SESSION['user']){
    \App\Services\Router::redirect('/profile');
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
    <h3>Регистрация</h3>
    <hr>
    <form action="/auth/register" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email почта</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
            <div id="passwordHelpBlock" class="form-text">
                Ваш пароль должен быть не меньше 8 символов.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Подтвердите пароль</label>
            <input type="password" name="passwordConfirm" class="form-control" required>

        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Фамилия</label>
            <input type="text" name="lastname" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Дата рождения</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Аватар</label>
            <input type="file" name="avatar" class="form-control" id="avatar">
            <div id="emailHelp" class="form-text">Необязательное поле</div>
        </div>
        <div class="d-flex">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="flexRadioDefault1" value="Мужчина">
                <label class="form-check-label me-3" for="flexRadioDefault1">
                    мужик
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="flexRadioDefault2" value="Женщина">
                <label class="form-check-label me-3" for="flexRadioDefault2">
                    женщик
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="check" id="flexRadioDefault3" value="Небинарный" checked>
                <label class="form-check-label mb-3 me-3" for="flexRadioDefault3">
                    небинарный
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Создать аккаунт</button>
    </form>

</div>

</body>
</html>