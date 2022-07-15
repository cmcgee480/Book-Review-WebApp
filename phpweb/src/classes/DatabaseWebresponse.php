<?php

class WebResponseDatabase{

   public $webresponsetimes = array();

    public function __construct(array $webresponsetimes){
        $this->webresponsetimes=$webresponsetimes;
    }

    public function addWebReponseTime($webresponsetime){
        array_push($this->webresponsetimes,$webresponsetime);
    }

    
    public function getWebResponseTime($webresponsetime){
        $webresponsetimeIsInArray = in_array($webresponsetime, $this->webresponsetimes);
        return $webresponsetimeIsInArray;
    }

    



}


?>