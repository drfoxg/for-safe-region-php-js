<?php

namespace MydeveloperswayCom\Encryption;

class ControllerEncryption extends Controller
{

    function __construct()
    {
        session_start();

        $adapterHtml = new HtmlAdapter();
        $adapterJson = new JsonAdapter();

        $this->model = new ModelEncryption($adapterJson);
//        $this->model = new ModelEncryption($adapterHtml);
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

        $this->view->generate('view_encryption.php', 'view_template.php', $data);
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
            header('Location:' . $host . '/encryption/search_crossword');

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

        $this->view->generate('view_encryption.php', 'view_template.php', $data);
    }

}
