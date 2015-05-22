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
if(isset($_SESSION['flujoVotanteData']))
{
    $flujoVotanteData = unserialize($_SESSION['flujoVotanteData']);
    if($flujoVotanteData != null)
        $noData = 'false';
    else
        $noData = 'true';
}


?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Módulo 3 - Datos Iniciales</title>
        <link rel="stylesheet" href="themes/Bootstrap.min.css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="datosInicialsPage" data-role="page" data-theme="a">
            <div data-role="header" data-position="inline">
                <h1>Módulo 3 - Datos Iniciales</h1>
                <div data-role="navbar">
                    <ul>
                        <li><a href="datosIniciales.php" rel="external" data-icon="home" class="ui-btn-active">Datos iniciales</a></li>
                        <div id="divVotos"><li><a href="flujoVotante.php" rel="external" data-icon="star">Votos</a></li></div>
                    </ul>
                </div>
            </div>


            <div data-role="content" data-theme="a">
                <h2>Inserta tus datos</h2>

                <div data-role="fieldcontain">
                        <label for="iName">Nombre:</label>
                        <input type="text" name="iName" id="iName" value=""  />
                </div>

                <div data-role="fieldcontain">
                        <label for="section" class="select">Sección:</label>
                        <select name="section" id="section" data-native-menu="false">
                                <option value="0">Sección 1</option>
                                <option value="1">Sección 2</option>
                                <option value="2">Sección 3</option>
                                <option value="3">Sección 4</option>
                        </select>
                </div>

                <div data-role="fieldcontain">
                        <label for="casilla" class="select">Casilla:</label>
                        <select name="casilla" id="casilla" data-native-menu="false">
                                <option value="0">Básica</option>
                                <option value="1">Contigua 1</option>
                                <option value="2">Contigua 2</option>
                                <option value="3">Extraordinaria</option>
                                <option value="4">Especial</option>
                        </select>
                </div>

                <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="button" onclick="setData();" data-theme="a">Actualiza Datos</button></div>
                </fieldset>

                <div align="center" id ='dILoadingSpinner'><i class="fa fa-spinner fa-spin fa-3x"></i></div>
                <div style="text-align: center; color: red;" id="divError"></div>

            </div>
            <script type='text/javascript'>
                $(document).ready(function(){
                    //Si los datos iniciales no han sido seteados entonces
                    //desactiva la TAB de Votos
                    $('#dILoadingSpinner').hide();
                    
                    if(<?php echo $noData; ?>)
                    {//El usuario no ha cargado aun los datos iniciales
                        $("#divVotos").hide();
                    }
                    else
                    {//Los datos Iniciales ya han sido cargados. Muestralos
                        // El selectmenu('refresh') es necesario debido al jquery mobile
                        $("#iName").val("<?php echo $flujoVotanteData->getNombreRMDC(); ?>");
                        $("#section").val("<?php echo $flujoVotanteData->getSeccion(); ?>").selectmenu('refresh');
                        $("#casilla").val("<?php echo $flujoVotanteData->getTipoCasilla(); ?>").selectmenu('refresh');
                    }
                });

                function setData()
                { //Manda los datos al servidor
                    $('#dILoadingSpinner').show();
                    $("#divError").hide();
                    $("#divError").html("");
                    
                    //VALIDAR AQUI QUE HAYA INSERTADO BIEN LOS DATOS

                    $.ajax({
                        type: "POST",
                        url: "datosIniciales_setData.php",
                        dataType: "html",
                        data:
                        {
                            nombreRMDC  : $("#iName").val(),
                            section     : $("#section").val(),
                            casilla     : $("#casilla").val()
                        },
                        success:
                            function(data)
                            {
                                $("#dILoadingSpinner").hide();

                                if(data.indexOf("OK") > -1)
                                {
                                    window.location = "flujoVotante.php";
                                }
                                else if(data.indexOf("ERROR") > -1)
                                {
                                    window.location = "index.php";
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
                                $("#dILoadingSpinner").hide();
                                $('#divError').show();
                                $("#divError").html("Error de conexión");
                            }
                    });
                }

            </script>
        </div>
    </body>
</html>
