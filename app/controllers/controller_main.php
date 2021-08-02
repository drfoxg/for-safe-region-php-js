<?php

namespace Mydevelopersway\Com\Job4;

class ControllerMain extends Controller
{

    function action_index()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }

}
