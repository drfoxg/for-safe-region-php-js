<?php

namespace MydeveloperswayCom\Encryption;

class Controller404 extends Controller
{

    function action_index()
    {
        // echo 'Controller404->action_index()';
        $this->view->generate('view_404.php', 'view_template.php');
    }

}
