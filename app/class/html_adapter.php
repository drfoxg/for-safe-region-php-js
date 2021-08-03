<?php

namespace MydeveloperswayCom\Encryption;

class HtmlAdapter implements IAdapter
{
    private $_html = null;
    private $_dataCount = null;

    // пример возвращаемого значения от poncy
    // <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 result-item">
    // <a class="resultquery ahint" id="helphref5"
    // onclick="showHint(5, this); return false;" href="#" title="ПИР" >ПИР</a>
    // <br />
    // </div>
    const RESULT_CLASS = '.resultquery';

    public function request($mask)
    {
        echo 'I am HtmlAdapter<br>';

        $url = IAdapter::API_URL_HTML.urldecode($mask);

        echo $url.'<br>';
        //var_dump($url);

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
        $html = file_get_contents($url, false, stream_context_create($context_options));

        // For production
        // $html = file_get_contents($url);

        $this->setHtml($html);
        $this->selectDoc();
        $this->setDataCount();

        $words = array();
        $i = 0;
        foreach (pq(self::RESULT_CLASS) as $item) {
            $words[$i] = $item->nodeValue;
            $i++;
        }

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

    private function setDataCount()
    {
        $this->_dataCount = pq('#result-count')->attr('data-count');
    }

    private function setHtml($html)
    {
        if (isset($html) && !empty($html)) {
            $this->_html = $html;
        }
    }

    private function getElemText($elem)
    {
        $pq = \phpQuery::newDocumentHTML($this->_html);

        $_elem = $pq->find($elem);
        $text = $_elem->html();

        return $text;
    }

    private function selectDoc()
    {
        $pq = \phpQuery::newDocumentHTML($this->_html);
        \phpQuery::selectDocument($pq);
    }
}
