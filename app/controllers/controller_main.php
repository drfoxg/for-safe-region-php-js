<?php

namespace MydeveloperswayCom\Encryption;

class ControllerMain extends Controller
{

    function action_index()
    {
        $this->view->generate('view_main.php', 'view_template.php');
    }

}
