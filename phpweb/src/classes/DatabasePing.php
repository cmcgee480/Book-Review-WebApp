<?php

class PingTimeDatabase{

   public $pingtimes = array();

    public function __construct(array $pingtimes){
        $this->pingtimes=$pingtimes;
    }

    public function addPingTime($pingtime){
        array_push($this->pingtimes,$pingtime);
    }

    
    public function getPingTime($pingtime){
        $pingtimeIsInArray = in_array($pingtime, $this->pingtimes);
        return $pingtimeIsInArray;
    }

    



}


?>