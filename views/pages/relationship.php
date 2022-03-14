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
        <h3>Заполните анкету подробнее</h3>
        <hr>
        <form>
            <div class="mb-2">
            </div>
            <div class="mb-2">
                <label for="" class="form-label">Я ищу:</label>
                <select id="one" class="form-select" aria-label="Default select example">
  <option value="друга" >Друга</option>
  <option value="пару">Пару</option>
  <option value="просто смотрю">Просто смотрю</option>
</select>
            <label for="" class="form-label mt-4">Обо мне:</label>
            <textarea type="text" class="form-control" id="about"></textarea>
                <div id="" class="form-text">Поделись с людьми информацией о себе!</div>

            <label for="" class="form-label mt-4" id="inter">Интересы:</label>

            <div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="спорт" id="checksport">
  <label class="form-check-label" for="checksport">
  Спорт
  </label>
</div>
<div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="путешествия" id="checktravel">
  <label class="form-check-label" for="checktravel">
  Путешествия
  </label>
</div>
<div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="мода" id="checkfashion">
  <label class="form-check-label" for="checkfashion">
  Мода
  </label>
</div>
<div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="компьютерные игры" id="checkpc">
  <label class="form-check-label" for="checkpc">
  Компьютерные игры
  </label>
</div>
<div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="музыка" id="checkmusic">
  <label class="form-check-label" for="checkmusic">
  Музыка
  </label>
</div>
<div class="form-check">
  <input class="form-check-input checkboxHobby" type="checkbox" value="рисование" id="checkart">
  <label class="form-check-label" for="checkart">
  Рисование
  </label>
</div>
<hr>

            </div>
            <p for="" class="mb-3 text-danger fs-6" id="msgReg"></p>
            
            <button type="submit" class="btn btn-primary ms-2" id="push-package">Отправить</button>
        </form>
    </div>
    </body>
    </html>
