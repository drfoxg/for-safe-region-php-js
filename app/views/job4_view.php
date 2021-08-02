<?php

use Mydevelopersway\Com\Job4\Route;
?>

<h1>Задание 4 (Шифровочка)</h1>

<p>При помощи приведенного шифра восстановите весь кроссворд, (не забывайте про <del>черные</del> серые клетки). В финале задания составьте ключевое слово.</p>

<?php
/*
  echo '<div>'
  if  (isset($crossword)) {
  echo '$_COOKIE["crossword"]: '.'<br>';//.$crossword;
  print_r($crossword);
  }
  echo '<div>'
 */
?>

<div class="row"><br></div>
<p>Шифр</p>
<div class="btn-group btn-matrix">
    <?php
    foreach ($cipher_matrix as $item) {
        echo '<div class="btn btn-default" onclick="OnCipherClick(this)">' . $item . '</div>';
    }
    ?>
</div>

<div class="row"><br></div>
<p>Кроссворд</p>
<div class="btn-group input-matrix">
    <?php
    foreach ($crossword_matrix as $item) {
        if ($item !== '0') {
            echo '<div class="btn btn-default single-line" onclick="OnCrosswordClick(this)" contenteditable="true">' . $item . '</div>';
        } else {
            echo '<div class="btn btn-default single-line hole" onclick="OnCrosswordClick(this)" contenteditable="true">' . $item . '</div>';
        }
    }
    ?>
</div>

<div class="row"><br></div>
<p>Ключевое слово</p>
<div class="btn-group keyword-matrix">
    <?php
    foreach ($keyword_matrix as $item) {
        echo '<div class="btn btn-default single-line" onclick="OnCrosswordClick(this)" contenteditable="true">' . $item . '</div>';
    }
    ?>
</div>

<div class="row"><br></div>

<form class="form-horizontal" id="search-crossword" name="search-crossword"  method="post" action="<?= Route::getRootFolder() . '/job4/search_crossword' ?>" >
    <div class="col-sm-2 control-label">
        <label for="mask">Маска:</label>
    </div>
    <div class="col-sm-6 job4-mask">
        <input name="mask" type="text" id="id_mask" value="<?php echo (isset($mask)) ? $mask : ''; ?>" placeholder="пример: то--р, л2в6" class="form-control input-md" required pattern="^[А-Яа-яЁё1-6-]+"/>
    </div>
    <div class="col-sm-2 find-button">
        <button type="submit" name="search" class="btn btn-md btn-primary btn-search pull-right"><span class="glyphicon glyphicon-search"></span> Найти </button>
    </div>

</form>
<br>
<div class="clearfix"></div>
<p></p>
<?php
/*
  echo '<br>';
  var_dump($searchresult_count);
  echo '<br>';
 */

if (isset($user_hint) &&
    $user_hint !== false &&
    !($searchresult_count === "0" || $searchresult_count === "")) {
    echo '<p>' . $user_hint . '</p>';
    echo '<div class="row"><br></div>';
}

if (isset($searchresult_count) && $searchresult_count === "0") {
    echo '<p>Поиск не дал результатов, пример запроса: то--р, л2в6</p>';
}

if (isset($searchresult_count) && $searchresult_count === "") {
    echo '<p>Поиск не дал результатов, сервис не доступен, попробуйте позже';
}

if (!empty($searchresult)) {
    //echo 'Текст из html: ', $data, '<br>';
    //var_dump($data);
    foreach ($searchresult as $item) {
        echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">' . $item . '</div>';
    }
    echo '<div class="clearfix"></div>';
    echo '<div class="row"><br></div>';
    echo '<p>Показано ' . count($searchresult) . ' из ' . $searchresult_count . '</p>';
}
?>
<div class="clearfix"></div>
<p><a href="<?= Route::getRootFolder() ?>">Главная</a></p>

<script src="<?= Route::getRootFolder() ?>/js/job4.js"></script>