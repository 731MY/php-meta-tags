<?php
namespace Meta;
use DOMDocument;

/**
 * Created by PhpStorm.
 * User: 731MY
 * Date: 6/29/18
 * Time: 9:28 AM
 */

class MetaFetcher {
    private $Reader;

    public function __construct(Reader $reader){
        $this->Reader = $reader;
    }

    /**
     * @param array|null $filter
     * @return array
     * @throws \BadUrlException
     * @throws \FileNotFoundException
     * @throws \FileNotReadableException
     * @throws \UnknownTypeException
     */
    public function meta(array $filter = null){
        $doc = new DOMDocument();

        @$doc->loadHTML($this->Reader->get());

        $output = [];

        $metas = $doc->getElementsByTagName('meta');


        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);

            $name = $meta->getAttribute('name');
            $content = $meta->getAttribute('content');

            if(empty($name)){
                $name = $meta->getAttribute('property');

                if(empty($name)){
                    $name = $meta->getAttribute('http-equiv');
                }

                if(empty($name)) continue;
            }

            if(count($filter) > 0){
                foreach($filter as $tag) {
                    if ($name == $tag) {
                        $output[$tag] = $content;
                    }
                }
            }else{
                $output[$name] = $content;
            }
        }

        return $output;
    }

}