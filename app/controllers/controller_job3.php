<?php

namespace Mydevelopersway\Com\Job4;

class ControllerJob3 extends Controller
{

    function action_index()
    {
        $this->view->generate('job3_view.php', 'template_view.php');
    }

}
