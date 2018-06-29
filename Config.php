<?php
/**
 * Created by PhpStorm.
 * User: 731MY
 * Date: 6/29/18
 * Time: 9:30 AM
 */

namespace Meta;


class Config {

    private $UserAgent = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
    private $Timeout = 10;
    private $Referer = null;

    /**
     * @param mixed $UserAgent
     * @return Config
     */
    public function setUserAgent($UserAgent){
        $this->UserAgent = $UserAgent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserAgent(){
        return $this->UserAgent;
    }

    /**
     * @param mixed $Timeout
     * @return Config
     */
    public function setTimeout($Timeout){
        $this->Timeout = $Timeout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeout(){
        return $this->Timeout;
    }

    /**
     * @param mixed $Referer
     * @return Config
     */
    public function setReferer($Referer){
        $this->Referer = $Referer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferer(){
        return $this->Referer;
    }

}