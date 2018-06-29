<?php
namespace Meta;
use BadUrlException;
use FileNotFoundException;
use FileNotReadableException;
use UnknownTypeException;

/**
 * Created by PhpStorm.
 * User: 731MY
 * Date: 6/29/18
 * Time: 9:29 AM
 */

class Reader {
    private $Config;
    private $PathOrData;
    private $Type;

    /**
     * Reader constructor.
     * @param $pathOrData
     * @param Type $type
     * @param Config|null $config
     */
    public function __construct($pathOrData, int $type = Type::URL, Config $config = null){
        $this->PathOrData = $pathOrData;
        $this->Type = $type;

        if($type == Type::URL){
            if(is_null($config)){
                $this->Config = new Config();
            }else{
                $this->Config = $config;
            }
        }
    }

    /**
     * @param $url
     * @return mixed
     */
    private function call($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->Config->getTimeout());
        curl_setopt($ch, CURLOPT_USERAGENT, $this->Config->getUserAgent());

        if(!is_null($this->Config->getReferer())){
            curl_setopt($ch, CURLOPT_REFERER, $this->Config->getReferer());
        }


        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * @return mixed
     * @throws FileNotFoundException
     * @throws FileNotReadableException
     * @throws BadUrlException
     * @throws UnknownTypeException
     */
    public function get() {
        if($this->Type === Type::URL){
            if(!filter_var($this->PathOrData, FILTER_VALIDATE_URL)){
                throw new BadUrlException();
            }

            return $this->call($this->PathOrData);
        } else if($this->Type === Type::FILE){

            if(!is_file($this->PathOrData)){
                throw new FileNotFoundException();
            } else if(is_readable($this->PathOrData)){
                throw new FileNotReadableException();
            }

            return file_get_contents($this->PathOrData);
        }else if($this->Type === Type::DATA){
            return $this->PathOrData;
        }

        throw new UnknownTypeException();
    }
}