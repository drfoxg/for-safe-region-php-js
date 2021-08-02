<?php

use Mydevelopersway\Com\Job4\Route;

?>

<h1>Задание 1 (технология PHP)</h1>

<p>Написать скрипт, который занимается созданием сокращенного варианта ФИО.<br>
    Например, вводим: Иванов Иван Петрович, а в результате должны получить: Иванов И. П.</p>

<form method="post" action="<?= Route::getRootFolder().'/job1/fullname' ?>">
<!-- <form method="post" action="/crossword/job1"> -->
    <div>
        <label for="surname">Фамилия:</label>
        <input name="surname" type="text" required>
    </div>
    <div>
        <label for="firstname">Имя:</label>
        <input name="firstname" type="text" required>
    </div>
    <div>
        <label for="patronymic">Отчество:</label>
        <input name="patronymic" type="text" required>
    </div>
    <input type="submit" name="do_cut_full_name" value="Отправить">

</form>
<br>
<?php
    if (!empty($data)) {
        echo 'Сокращенный вариант ФИО: ', $data, '<br>';
    }
?>
<br>
<p><a href="<?= Route::getRootFolder() ?>">Главная</a></p>