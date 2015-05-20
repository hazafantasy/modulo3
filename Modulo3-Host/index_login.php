<?php

if(PHP_OS == "WINNT")
{
    /*Windows Includes*/
    require_once dirname(__FILE__).'\includes\db\Usuario.php';
    require_once dirname(__FILE__).'\includes\tools\tools.php';
}
else
{
    /*Unix / Linux includes*/
    require_once dirname(__FILE__).'/includes/db/Usuario.php';
    require_once dirname(__FILE__).'/includes/tools/tools.php';
}

tools::startSession();

$userName   = $_POST["usr"];
$pass       = $_POST["pass"];

$user = tools::login($userName, $pass);

if($user != null)
    echo "OK";
else
    echo "ERROR";

?>
