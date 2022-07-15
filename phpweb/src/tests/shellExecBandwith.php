<?php
//shell exec function that when run by cron job will run the bandwidthTest.php file
//The cron job runs this file every 60 seconds.
shell_exec("php bandwithTest.php");


?>





