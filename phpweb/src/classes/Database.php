<?php

class PageloadDatabase{

    //Mock Database for holding pageload times
    //Used instead of MySQL database connection
    //Takes array of pageloadtimes as constructor variable
   public $pageloadtimes = array();

    public function __construct(array $pageloadtimes){
        $this->pageloadtimes=$pageloadtimes;
    }

    public function addPageLoadTime($pageloadtime){
        array_push($this->pageloadtimes,$pageloadtime);
    }

    
    public function getPageLoadTime($pageloadtime){
        $pageloadIsInArray = in_array($pageloadtime, $this->pageloadtimes);
        return $pageloadIsInArray;
    }

    



}


?>