<?php

namespace MydeveloperswayCom\Encryption;

class View
{
    // здесь можно указать общий вид по умолчанию
    // public $view_template;

    function generate($content_view, $view_template, $data = null)
    {
        if (is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }



        include 'app/views/' . $view_template;
    }

}
