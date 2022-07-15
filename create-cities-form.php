<?php
?>

<form id="form" class="form">
    <h3 class="form-title">Добавить город</h3>
    <input class="form-input" type="text" name="title" value="" id="title" dir="auto" aria-label="Название "
           aria-required="true"
           required title="Название" placeholder="Название *">
    <textarea class="form-textarea" type="text" name="description" id="title" dir="auto" aria-label="Описание"
              aria-required="true"
              required title="Описание" placeholder="Описание *"></textarea>
    <div class="form-input-group">
        <label for="file" class="form-label">Фото: </label>
        <input id="file" type="file" name="thumbnail">
    </div>

    <button class="btn-submit" type="submit">Добавить</button>

</form>

