<?php

namespace Mydevelopersway\Com\Job4;

class ControllerJob4 extends Controller
{

    function __construct()
    {
        session_start();

        $this->model = new ModelJob4();
        $this->view = new View();
    }

    function action_index()
    {
        unset($_SESSION['data']);
        unset($_COOKIE['crossword']);
        unset($_COOKIE['keyword']);

        $data['cipher_matrix'] = $this->model->getCipherMatrix();
        $data['crossword_matrix'] = $this->model->getCrosswordMatrix();
        $data['keyword_matrix'] = $this->model->getKeywordMatrix();

        $this->view->generate('job4_view.php', 'template_view.php', $data);
    }

    function action_search_crossword()
    {
        if (isset($_POST['search'])) {

            $data['searchresult'] = $this->model->getData($_POST['mask']);

            $data['mask'] = $this->model->getMask();
            $data['searchresult_count'] = $this->model->getDataCount();
            $data['user_hint'] = $this->model->getUserHint();
            
            $data['cipher_matrix'] = $this->model->getCipherMatrix();
            $data['crossword_matrix'] = $this->model->getCrosswordMatrix();
            $data['keyword_matrix'] = $this->model->getKeywordMatrix();

            $_SESSION['data'] = $data;

            $host = 'http://' . $_SERVER['HTTP_HOST'] . Route::getRootFolder();
            header('Location:' . $host . '/job4/search_crossword');

            exit();
        }

        if (isset($_SESSION['data'])) {
            $data = $_SESSION['data'];
        } else {
            $data = '';
            $data['cipher_matrix'] = $this->model->getCipherMatrix();
            $data['crossword_matrix'] = $this->model->getCrosswordMatrix();
            $data['keyword_matrix'] = $this->model->getKeywordMatrix();
        }

        $this->view->generate('job4_view.php', 'template_view.php', $data);
    }

}
