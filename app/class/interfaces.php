<?php

namespace MydeveloperswayCom\Encryption;

interface IAdapter
{
    const API_URL_HTML = 'https://poncy.ru/crossword/?mask=';
    const API_URL_JSON = 'https://poncy.ru/crossword/crossword-solve.jsn?mask=';

    public function request($url);
    public function getDataCount();
}
