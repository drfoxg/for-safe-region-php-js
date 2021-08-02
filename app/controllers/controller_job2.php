<?php

namespace Mydevelopersway\Com\Job4;

class ControllerJob2 extends Controller
{

    function action_index()
    {
        $this->view->generate('job2_view.php', 'template_view.php');
    }

}
