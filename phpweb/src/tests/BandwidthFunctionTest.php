<?php


use PHPUnit\Framework\TestCase;

class BandwidthFunctionTest extends TestCase
{

    //Mock Bandwidth function that runs the same logic as bandwidth function
    //Adds Bandwidth to Database class which takes bandwidth array as constructor
    //Used this class instead of actual database connection
    public function testBandwidthTest()
    {
        $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/DatabaseBandwidth.php";
        require_once $pathdb;
        $bandwidtharray = array();
        $bandwidtharray[] = '13.3535';
        $bandwidtharray[] = '24.5697';
        $db = new BandwidthDatabase($bandwidtharray);
        include_once('MockFunctions.php');
        $bandwidth = mockBandwithTest();
        $db->addBandwidth($bandwidth);
        $expectedBoolean = true;
        $actualBoolean = $db->getBandwidth($bandwidth);
        $this->assertEquals($expectedBoolean, $actualBoolean);
    }
}
