<?php

class BandwidthDatabase{

   public $bandwidtharray = array();

    public function __construct(array $bandwidtharray){
        $this->bandwidtharray=$bandwidtharray;
    }

    public function addBandwidth($bandwidth){
        array_push($this->bandwidtharray,$bandwidth);
    }

    
    public function getBandwidth($bandwidth){
        $bandwidthIsInArray = in_array($bandwidth, $this->bandwidtharray);
        return $bandwidthIsInArray;
    }

    



}


?>