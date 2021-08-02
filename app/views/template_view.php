<?php

use Mydevelopersway\Com\Job4\Route;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha512-Dop/vW3iOtayerlYAqCgkVr2aTr2ErwwTYOvRFUpzl2VhCMJyjQF0Q9TjUXIo6JhuM/3i0vVEt2e/7QQmnHQqw==" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= Route::getRootFolder() ?>/css/style.css">
    <link rel="stylesheet" href="<?= Route::getRootFolder() ?>/css/job2.css">
    <link rel="stylesheet" href="<?= Route::getRootFolder() ?>/css/job4.css">
	<title>Тест от Безопасный регион | Главная</title>
</head>
<body>

    <div id="content">
        <div id="header">

        </div>
        <div id="center">
            <img src="<?= Route::getRootFolder() ?>/images/ministry_logo1.jpg" alt="фотография">
            <div id="box_text">
                <?php include 'app/views/'.$content_view; ?>
            </div>
        </div>
    </div>

    <div id="footer">Copyright © 2021 <a href="http://mydevelopersway.com/" target="_blank">Mydevelopersway.com</a></div>

    <!--
    <div id="loading" class="spinner-container" style="display: none;">
        <div class="spinner-wrap">
            <div class="spinner-element spinner-element-1">
                <kbd class="spinner-kbd"><img src="<?= Route::getRootFolder() ?>/images/spinner.png" alt="spinner"></kbd>
            </div><p><br>ИЩУ ОТВЕТ</p>
        </div>
    </div>
    --!>

</body>
</html>
