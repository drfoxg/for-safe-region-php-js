<?php

use Mydevelopersway\Com\Job4\Route;

?>

<h1>Задание 2 (технология CSS)</h1>

<p>Необходимо реализовать следующее:</p>
<ol>
    <li>Поворот элемента на 90°</li>
    <li>Отражение по горизонтали</li>
    <li>Поворот на 360° при наведении</li>
    <li>Увеличение блока в 2 раза, при наведении</li>
</ol>

<p>Реализация поворота элемента на 90°</p>
<div class="rotate-90 show-block">Lorem Ipsum</div>
<div class="clearfix"></div>
<br>
<p>Реализация отражение по горизонтали</p>
<div class="pre-flip">Lorem Ipsum</div>
<div class="flip-h">Lorem Ipsum</div>
<div class="clearfix"></div>
<br>
<p>Реализация поворота на 360° при наведении</p>
<div class="rotate-360 show-block">Lorem Ipsum</div>
<div class="clearfix"></div>
<br>
<p>Реализация увеличения блока в 2 раза, при наведении</p>
<div class="scale2 show-block">Lorem Ipsum</div>
<div class="clearfix"></div>
<br>

<br>
<p><a href="<?= Route::getRootFolder() ?>">Главная</a></p>