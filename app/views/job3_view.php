<?php

use Mydevelopersway\Com\Job4\Route;

?>

<h1>Задание 4 (технология Javascript)</h1>

<p>Напишите функцию, принимающую массив произвольных слов и на выходе дающую двумерный массив анаграмм:</p>
<p>['стол', 'барокко', 'слот', 'кот', 'кошка', 'ток', 'коробка']<br>
// -><br>
[<br>
  ['стол', 'слот'],<br>
  ['кот', 'ток'],<br>
  ['барокко', 'коробка'],<br>
]<br>
</p>
<div id="result"></div>
<br>
<p><a href="<?= Route::getRootFolder() ?>">Главная</a></p>

<script src="<?= Route::getRootFolder() ?>/js/job3.js"></script>