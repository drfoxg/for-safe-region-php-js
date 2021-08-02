<?php

namespace Mydevelopersway\Com\Job4;

class ModelJob1 extends Model
{

    private $surname;
    private $firstname;
    private $patronymic;

    public function getData($param = null)
    {

        if (isset($this->surname)) {
            $ret_val = $this->surname;
        }

        if (isset($this->firstname)) {
            $ret_val = $ret_val . ' ' . mb_strtoupper(mb_substr($this->firstname, 0, 1)) . '.';
        }

        if (isset($this->patronymic)) {
            $ret_val = $ret_val . ' ' . mb_strtoupper(mb_substr($this->patronymic, 0, 1)) . '.';
        }

        if (isset($ret_val)) {
            return $ret_val;
        } else {
            return false;
        }
    }

    public function setSurname($surname)
    {
        if (isset($surname) && !empty($surname)) {
            $this->surname = $surname;
        }
    }

    public function setFirstname($firstname)
    {
        if (isset($firstname) && !empty($firstname)) {
            $this->firstname = $firstname;
        }
    }

    public function setPatronymic($patronymic)
    {
        if (isset($patronymic) && !empty($patronymic)) {
            $this->patronymic = $patronymic;
        }
    }

    private function mbUcfirst($string, $enc = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
            mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }

}
