<?php
/**
 * Created by PhpStorm.
 * User: chiku
 * Date: 19/3/18
 * Time: 9:28 PM
 */

class Proxify {
    public $url = "";

    public function __construct($url) {
        $this->url = $url;
    }

    public function urlLength() {
        return strlen($this->url);
    }

    public function fetchURL() {
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POST => false,
            CURLOPT_USERAGENT => $user_agent,
            CURLOPT_COOKIEFILE => "cookie.txt",
            CURLOPT_COOKIEJAR => "cookie.txt",
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING => "",       // handle all encodings
            CURLOPT_AUTOREFERER => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT => 120,      // timeout on response
            CURLOPT_MAXREDIRS => 5,       // stop after 5 redirects
        );

        $ch = curl_init($this->url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }

}