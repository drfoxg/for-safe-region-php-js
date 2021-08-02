<?php

namespace Mydevelopersway\Com\Job4;

class Controller404 extends Controller
{

    function action_index()
    {
        // echo 'Controller404->action_index()';
        $this->view->generate('404_view.php', 'template_view.php');
    }

}
