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
$user = tools::getLoggedUser();

if($user == null)
{
    echo "ERROR";
    return;
}

$nameRMDC   = $_POST["nombreRMDC"];
$section    = $_POST["section"];
$casilla    = $_POST["casilla"];
$userName   = $user->getUserName();

$flujoVotanteData = new FlujoVotante();
$flujoVotanteData->setUserName($userName);
$flujoVotanteData->setNombreRMDC($nameRMDC);
$flujoVotanteData->setSeccion($section);
$flujoVotanteData->setTipoCasilla($casilla);

//Guardamos los datos de sesion y regresamos clave
$_SESSION['flujoVotanteData'] = serialize($flujoVotanteData);
echo "OK";

?>

