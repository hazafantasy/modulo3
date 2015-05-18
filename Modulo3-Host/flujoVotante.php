<?php


?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Módulo 3 - Flujo Votante</title>
        <link rel="stylesheet" href="themes/Bootstrap.css">
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
                
                
                <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="button" onclick="sendVotante();">Enviar Votante</button></div>
                </fieldset>
            </div>
            
            <script type='text/javascript'>
                $(document).bind("pageinit",function()
                {
                    //Si los datos iniciales no han sido seteados entonces
                    //desactiva la TAB de Votos
                    $('#fVLoadingSpinner').hide();
                    $('#fVOK').hide();
                });
                
                function sendVotante()
                {
                    
                }
                
            </script>
        </div>
    </body>
</html>
