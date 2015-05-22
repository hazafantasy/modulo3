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

//Verifica si los datos iniciales ya fueron ingresados
$noData = 'true';
$flujoVotanteData = null;
$userName   = '';
$nombreRMDC = '';
$seccion    = '';
$casilla    = '';

if(isset($_SESSION['flujoVotanteData']))
{
    $flujoVotanteData = unserialize($_SESSION['flujoVotanteData']);
    if($flujoVotanteData != null)
    {
        $noData = 'false';
        $userName   = $flujoVotanteData->getUserName();
        $nombreRMDC = $flujoVotanteData->getNombreRMDC();
        //Obtener los nombres de la seccion y el tipo de casilla
        //para desplegar en lugar de los ID's
        $seccion    = $flujoVotanteData->getSeccion();
        $casilla    = $flujoVotanteData->getTipoCasilla();
    }
    else
    {
        $noData = 'true';
    }
}

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Módulo 3 - Flujo Votante</title>
        <link rel="stylesheet" href="themes/Bootstrap.min.css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="flujoVotantePage" data-role="page" data-theme="a">
            <div data-role="header" data-position="inline">
                <h1>Módulo 3 - Flujo Votante</h1>
                <div data-role="navbar">
                    <ul>
                        <li><a href="datosIniciales.php" rel="external" data-icon="home">Datos iniciales</a></li>
                        <li><a href="flujoVotante.php" rel="external" data-icon="star" class="ui-btn-active">Votos</a></li>
                    </ul>
                </div>
            </div>

            <div data-role="content" data-theme="a">
                <h2>Tus Datos</h2>
                <div data-role="fieldcontain">
                    <label id="userDataLabel">...</label>
                </div>
                <h2>Datos del Votante</h2>
                <div data-role="fieldcontain">
                    <label for="lnd">LND:</label>
                    <input type="text" name="lnd" id="lnd" value="" />
                </div>

                <div align="center" id ='fVLoadingSpinner'><i class="fa fa-spinner fa-spin fa-3x"></i></div>
                <div align="center" id ='fVOK'><i class="fa fa-check fa-4x"></i></div>
                <div style="text-align: center; color: red;" id="divError"></div>
                
                <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="button" onclick="sendVotante();">Enviar Votante</button></div>
                </fieldset>
            </div>
            
            <script type='text/javascript'>
                $(document).bind("pageinit",function()
                {
                    if(<?php echo $noData; ?>)
                    {//No existen datos de usuario
                        //MUESTRA UN BOOTBOX Alert
                        window.location = "datosIniciales.php";
                    }
                    
                    var userName    = '<?php echo $userName; ?>';
                    var nombreRMDC  = '<?php echo $nombreRMDC; ?>';
                    var seccion     = '<?php echo $seccion; ?>';
                    var casilla     = '<?php echo $casilla; ?>';
                    var datos       = '';
                    
                    datos  = 'Usuario: '  + userName     + '<br>';
                    datos += 'Nombre:  '  + nombreRMDC   + '<br>';
                    datos += 'Seccion:  ' + seccion      + '<br>';
                    datos += 'Casilla:  ' + casilla      + '<br>';
                    
                    $('#userDataLabel').html(datos);
                    
                    $('#fVLoadingSpinner').hide();
                    $('#fVOK').hide();
                });
                
                function sendVotante()
                {
                    $('#fVLoadingSpinner').show();
                    $("#divError").hide();
                    $("#divError").html("");
                    $('#fVOK').hide();
                    
                    $.ajax({
                        type: "POST",
                        url: "flujoVotante_sendVoto.php",
                        dataType: "html",
                        data:
                        {
                            LND  : $("#lnd").val()
                        },
                        success:
                            function(data)
                            {
                                $("#fVLoadingSpinner").hide();

                                if(data.indexOf("OK") > -1)
                                {
                                    $('#fVOK').show();
                                    $("#lnd").val("");
                                }
                                else if(data.indexOf("ERROR") > -1)
                                {
                                    $('#divError').show();
                                    $("#divError").html("Datos corruptos");
                                }
                                else if(data.indexOf("ALREADY") > -1)
                                {
                                    $('#divError').show();
                                    $("#divError").html("El votante ya se encontraba registrado");
                                }
                                else
                                {
                                    $('#divError').show();
                                    $("#divError").html(data);
                                }
                            },
                        error:
                            function()
                            {
                                $("#fVLoadingSpinner").hide();
                                $('#divError').show();
                                $("#divError").html("Error de conexión");
                            }
                    });
                }
                
            </script>
        </div>
    </body>
</html>
