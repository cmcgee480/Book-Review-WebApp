<?php


use PHPUnit\Framework\TestCase;

class MockFunctionTest extends TestCase
{
    //Mock PageLoad function that runs the same logic as page load function
    //Adds page load to Database class which takes pageloads array as constructor
    //Used this class instead of actual database connection
    public function testPageLoadFunction()
    {
        $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/Database.php";
        require_once $pathdb;
        $pageloadtimes = array();
        $pageloadtimes[] = '13.3534';
        $pageloadtimes[] = '24.546';
        $db = new PageloadDatabase($pageloadtimes);
        include_once('MockFunctions.php');
        $url = 'http://www.google.co.uk';
        $pageloadtime = mockPageload($url);
        $db->addPageLoadTime($pageloadtime);
        $expectedBoolean = true;
        $actualBoolean = $db->getPageLoadTime($pageloadtime);
        $this->assertEquals($expectedBoolean, $actualBoolean);
    }

    //Mock PingTime function that runs the same logic as ping time function
    //Adds pingtime to Database class which takes pingtimes array as constructor
    //Used this class instead of actual database connection
    public function testPingTimeFunction()
    {
        $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/DatabasePing.php";
        require_once $pathdb;
        $pingtimes = array();
        $pingtimes[] = '13.3534';
        $pingtimes[] = '24.546';
        $db = new PingTimeDatabase($pingtimes);
        include_once('MockFunctions.php');
        $host = 'phpweb.c40112620.qpc.hal.davecutting.uk';
        $pingtime = mockPing($host);
        $db->addPingTime($pingtime);
        $expectedBoolean = true;
        $actualBoolean = $db->getPingTime($pingtime);
        $this->assertEquals($expectedBoolean, $actualBoolean);
    }

    //Mock WebResponseTime function that runs the same logic as web response time function
    //Adds WebReponseTime to Database class which takes webresponsetime array as constructor
    //Used this class instead of actual database connection
    public function testWebResponseTimeFunction()
    {
        $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/DatabaseWebresponse.php";
        require_once $pathdb;
        $webresponsetimes = array();
        $webresponsetimes[] = '13.3535';
        $webresponsetimes[] = '24.5697';
        $db = new WebResponseDatabase($webresponsetimes);
        include_once('MockFunctions.php');
        $url = 'http://www.google.co.uk';
        $webresponsetime = mockWebResponse($url);
        $db->addWebReponseTime($webresponsetime);
        $expectedBoolean = true;
        $actualBoolean = $db->getWebResponseTime($webresponsetime);
        $this->assertEquals($expectedBoolean, $actualBoolean);
    }

   
}
