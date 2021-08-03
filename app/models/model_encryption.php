<?php

namespace MydeveloperswayCom\Encryption;

/**
 * Class \MydeveloperswayCom\Encryption\ModelJob4.
 *
 * @copyright  Copyright © 2012-2021 Mydevelopersway.com
 * @license    MIT License
 */

// TODO: класс делает слишком много, разложить на композицию
class ModelEncryption extends Model
{

    // маска с + или -, только такую принимает poncy
    private $_mask;
    // маска с цифрами
    private $_displayMask;
    private $_dataCount = null;
    private $_cipherMatrix = [
        1, 'А', 'В', 'Г',
        2, 'Е', 'И', 'К',
        3, 'Л', 'Н', 'О',
        4, 'П', 'Р', 'С',
        5, 'Т', 'У', 'Щ',
        6, 'Ь', 'Я', 0,
    ];
    private $_crosswordMatrix = [
        1, 1, 5, 3, 2, 4, 1, 5, 2, 6,
        1, 6, 5, 6, 3, 3, 5, 3, 6, 1,
        5, 4, 2, 4, 2, 5, 1, 3, 2, 2,
        3, 6, 5, 5, 5, 1, 6, 5, 6, 3,
        4, 2, 1, 3, 6, 3, 3, 4, 5, 6
    ];
    private $_keywordMatrix = [
        ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '
    ];
    private $_cipherVector = [
        1 => ['А', 'В', 'Г'],
        2 => ['Е', 'И', 'К'],
        3 => ['Л', 'Н', 'О'],
        4 => ['П', 'Р', 'С'],
        5 => ['Т', 'У', 'Щ'],
        6 => ['Ь', 'Я', ' ']
    ];
    private $_filters = array();
    private $_userHint = null;

    private $_adapter;

    public function __construct(IAdapter $adapter)
    {
        $this->_adapter = $adapter;
    }

    const USER_HINT = 'Нет совпадений по шифру.<br>Пожалуйста, измените маску.';

    public function getData($mask = null)
    {
        $this->setMask(htmlentities(trim($_POST['mask']), ENT_QUOTES, 'UTF-8'));

        $ret_val = $this->_adapter->request($this->_mask);
        $this->setDataCount($this->_adapter->getDataCount());

        $short_ret_val = $this->applyFilters($ret_val);

        if (is_bool($short_ret_val) && $short_ret_val == false) {
            // нет совпадений
            $this->setUserHint();
        } else {
            $ret_val = $short_ret_val;
            $this->cleanUserHint();
        }

        return $ret_val;
    }

    public function getUserHint()
    {
        if (isset($this->_userHint)) {
            if (isset($this->_mask)) {
                $hint = $this->_userHint . '<br>Все возможные слова для маски: ' . $this->_mask;
                return $hint;
            } else {
                return $this->_userHint;
            }
        }

        return false;
    }

    private function setUserHint()
    {
        $this->_userHint = self::USER_HINT;
    }

    private function cleanUserHint()
    {
        unset($this->_userHint);
    }

    public function getDataCount()
    {
        if (isset($this->_dataCount)) {
            return $this->_dataCount;
        } else {
            return false;
        }
    }

    private function setDataCount($count)
    {
        $this->_dataCount = $count;
    }

    public function getMask()
    {
        if (isset($this->_displayMask) && !empty($this->_displayMask)) {
            return $this->_displayMask;
        } else {
            $this->_displayMask = '-';
            return $this->_displayMask;
        }
    }

    private function setMask($mask)
    {
        if (isset($mask) && !empty($mask)) {
            $mask_num = array();
            $letters = array();
            $digits = array();

            $is_numeric_mask = false;

            $chars = preg_split('//u', $mask, null, PREG_SPLIT_NO_EMPTY);
            foreach ($chars as $key => $char) {
                if (is_numeric($char)) {
                    $is_numeric_mask = true;
                    $letters[$key] = ' ';
                    $digits[$key] = mb_strtoupper($char);
                    $mask_num[$key] = '-';

                    $digits[$key] = $this->_cipherVector[$digits[$key]];
                } else {
                    $digits[$key] = [' '];
                    $letters[$key] = mb_strtoupper($char);
                    $mask_num[$key] = $letters[$key];
                }
            }

            //print_r($digits);
            //print_r($letters);
            //print_r($mask);

            $this->_displayMask = $mask;
            if ($is_numeric_mask) {
                $this->doFilters($digits, $letters);
                $this->_mask = implode($mask_num);
            } else {
                $this->_mask = $mask;
                $this->cleanFilters();
            }
        }
    }

    // получаем декартовое произведение массивов в $cartesian_product
    // и заменяем пробелы(это были буквы из маски)
    // в полученных массивах буквами из массива $merge_arr
    private function doFilters($cartesian_product, $merge_arr)
    {
        if (is_array($cartesian_product) && is_array($merge_arr)) {
            $result = Cartesian::build($cartesian_product);

            foreach ($result as $key => &$item) {
                foreach ($item as $subkey => &$subitem) {
                    if ($subitem == ' ') {
                        $subitem = $merge_arr[$subkey];
                    }
                }
                $item = implode($item);
            }

            $this->_filters = $result;
        } else {
            return false;
        }
    }

    private function cleanFilters()
    {
        unset($this->_filters);
    }

    private function applyFilters($data)
    {
        if (isset($this->_filters) == false) {
            return false;
        }

        $result = array_intersect($data, $this->_filters);

        if (empty($result)) {
            return false;
        }

        return $result;
    }

    public function getCipherMatrix()
    {
        return $this->_cipherMatrix;
    }

    public function getCrosswordMatrix()
    {
        if (isset($_COOKIE['crossword']) && !empty($_COOKIE['crossword'])) {
            $crossword_utf = json_decode($_COOKIE['crossword']);
            $this->_crosswordMatrix = $this->jsonFixCyr($crossword_utf);
        }

        return $this->_crosswordMatrix;
    }

    public function getKeywordMatrix()
    {
        if (isset($_COOKIE['keyword']) && !empty($_COOKIE['keyword'])) {
            $keyword_utf = json_decode($_COOKIE['keyword']);
            $this->_keywordMatrix = $this->jsonFixCyr($keyword_utf);
        }

        return $this->_keywordMatrix;
    }

    private function jsonFixCyr($json_str)
    {
        $cyr_chars = array(
            '%u0430' => 'а', '%u0410' => 'А',
            '%u0431' => 'б', '%u0411' => 'Б',
            '%u0432' => 'в', '%u0412' => 'В',
            '%u0433' => 'г', '%u0413' => 'Г',
            '%u0434' => 'д', '%u0414' => 'Д',
            '%u0435' => 'е', '%u0415' => 'Е',
            '%u0451' => 'ё', '%u0401' => 'Ё',
            '%u0436' => 'ж', '%u0416' => 'Ж',
            '%u0437' => 'з', '%u0417' => 'З',
            '%u0438' => 'и', '%u0418' => 'И',
            '%u0439' => 'й', '%u0419' => 'Й',
            '%u043a' => 'к', '%u041a' => 'К',
            '%u043b' => 'л', '%u041b' => 'Л',
            '%u043c' => 'м', '%u041c' => 'М',
            '%u043d' => 'н', '%u041d' => 'Н',
            '%u043e' => 'о', '%u041e' => 'О',
            '%u043f' => 'п', '%u041f' => 'П',
            '%u0440' => 'р', '%u0420' => 'Р',
            '%u0441' => 'с', '%u0421' => 'С',
            '%u0442' => 'т', '%u0422' => 'Т',
            '%u0443' => 'у', '%u0423' => 'У',
            '%u0444' => 'ф', '%u0424' => 'Ф',
            '%u0445' => 'х', '%u0425' => 'Х',
            '%u0446' => 'ц', '%u0426' => 'Ц',
            '%u0447' => 'ч', '%u0427' => 'Ч',
            '%u0448' => 'ш', '%u0428' => 'Ш',
            '%u0449' => 'щ', '%u0429' => 'Щ',
            '%u044a' => 'ъ', '%u042a' => 'Ъ',
            '%u044b' => 'ы', '%u042b' => 'Ы',
            '%u044c' => 'ь', '%u042c' => 'Ь',
            '%u044d' => 'э', '%u042d' => 'Э',
            '%u044e' => 'ю', '%u042e' => 'Ю',
            '%u044f' => 'я', '%u042f' => 'Я',

            '%u043A' => 'к', '%u041A' => 'К',
            '%u043B' => 'л', '%u041B' => 'Л',
            '%u043C' => 'м', '%u041C' => 'М',
            '%u043D' => 'н', '%u041D' => 'Н',
            '%u043E' => 'о', '%u041E' => 'О',
            '%u043F' => 'п', '%u041F' => 'П',

            '%u044A' => 'ъ', '%u042A' => 'Ъ',
            '%u044B' => 'ы', '%u042B' => 'Ы',
            '%u044C' => 'ь', '%u042C' => 'Ь',
            '%u044D' => 'э', '%u042D' => 'Э',
            '%u044E' => 'ю', '%u042E' => 'Ю',
            '%u044F' => 'я', '%u042F' => 'Я',

            '\r' => '',
            '\n' => '<br />',
            '\t' => ''
        );

        foreach ($cyr_chars as $cyr_char_key => $cyr_char) {
            $json_str = str_replace($cyr_char_key, $cyr_char, $json_str);
        }

        return $json_str;
    }
}
