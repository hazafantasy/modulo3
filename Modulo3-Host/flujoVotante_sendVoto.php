<?php

if(PHP_OS == "WINNT")
{
    /*Windows Includes*/
    require_once dirname(__FILE__).'\includes\db\Usuario.php';
    require_once dirname(__FILE__).'\includes\db\FlujoVotante.php';
    require_once dirname(__FILE__).'\includes\tools\tools.php';
}
else
{
    /*Unix / Linux includes*/
    require_once dirname(__FILE__).'/includes/db/Usuario.php';
    require_once dirname(__FILE__).'/includes/db/FlujoVotante.php';
    require_once dirname(__FILE__).'/includes/tools/tools.php';
}

tools::startSession();
$user               = tools::getLoggedUser();
$flujoVotanteData   = unserialize($_SESSION['flujoVotanteData']);
$lnd                = $_POST['LND'];

if($user != null && $flujoVotanteData != null && $lnd != '')
{
    $flujoVotanteData->setLND($lnd);
    $flujoVotanteData->setCoordenadas('');
    
    $result = FlujoVotante::insertVoto($flujoVotanteData);
    if($result == 'ADDED')
    {
        echo "OK";
    }
    else if($result == 'ALREADY')
    {
        echo "ALREADY";
    }
}
else
{
    echo "ERROR";
}

?>

