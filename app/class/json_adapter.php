<?php

namespace MydeveloperswayCom\Encryption;

class JsonAdapter implements IAdapter
{
    private $_dataCount = null;

    public function request($mask)
    {
        $url = IAdapter::API_URL_JSON.urldecode($mask);

        /*
         * Note: This has very significant security implications.
         * Disabling verification potentially permits a MITM(https://en.wikipedia.org/wiki/Man-in-the-middle_attack)
         * attacker to use an invalid certificate to eavesdrop on the requests.
         * While it may be useful to do this in local development,
         * other approaches should be used in production.
         */
        $context_options = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // For development
        $json = file_get_contents($url, false, stream_context_create($context_options));

        // For production
        // $html = file_get_contents($url);

        // $test = '{"words": ["\u042f\u0425\u041d\u0418\u042f"], "desc": {"title": "5 \u0431\u0443\u043a\u0432, \u043f\u0435\u0440\u0432\u0430\u044f \"\u044f\", \u043f\u043e\u0441\u043b\u0435\u0434\u043d\u044f\u044f \"\u044f\" \u0441\u043a\u0430\u043d\u0432\u043e\u0440\u0434", "original_desc": "", "description": "\u043e\u0442\u0432\u0435\u0442 \u043d\u0430 \u043a\u0440\u043e\u0441\u0441\u0432\u043e\u0440\u0434 / \u0441\u043a\u0430\u043d\u0432\u043e\u0440\u0434, \u0441\u043b\u043e\u0432\u043e \u0438\u0437 5 (\u043f\u044f\u0442\u0438) \u0431\u0443\u043a\u0432, \u043f\u0435\u0440\u0432\u0430\u044f \"\u044f\", \u043f\u043e\u0441\u043b\u0435\u0434\u043d\u044f\u044f \"\u044f\"", "h1": "5 (\u043f\u044f\u0442\u044c) \u0431\u0443\u043a\u0432, \u0441\u043a\u0430\u043d\u0432\u043e\u0440\u0434", "index": false, "count_letters": 5, "goal": false, "url": "/crossword/?mask=\u044f---\u044f", "h1s": "5 \u0431\u0443\u043a\u0432", "mask": "\u044f---\u044f", "desc": ""}, "count": 1, "simplification": false, "first_description": {"data": "", "images": ["/media/uploads/dict/sln/y/a/yahniya.jpg"], "tokens": ["\u0431\u0430\u043b\u043a\u0430\u043d\u0441\u043a. \u0431\u043b\u044e\u0434\u043e \u043f\u043e \u0442\u0438\u043f\u0443 \u0442\u0443\u0440\u0435\u0446\u043a\u0438\u0445 \u00ab\u0436\u0430\u0440\u0435\u043d\u044b\u0445 \u0441\u0443\u043f\u043e\u0432\u00bb", "\u0433\u0443\u0441\u0442\u043e\u0435 \u0431\u043b\u044e\u0434\u043e \u0438\u0437 \u0431\u0430\u0440\u0430\u043d\u0438\u043d\u044b \u0441 \u043b\u0443\u043a\u043e\u043c \u0438 \u0441\u0430\u0445\u0430\u0440\u043e\u043c, \u0438\u0437 \u043f\u0435\u0447\u0435\u043d\u0438 \u0438\u043b\u0438 \u0440\u044b\u0431\u044b"]}, "similar": []}';
        // $data = json_decode($test, true);

        $data = json_decode($json, true);
        $words = array_values($data['words']);
        $this->setDataCount(isset($data['count'])?$data['count']:"");

        return $words;
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
}
