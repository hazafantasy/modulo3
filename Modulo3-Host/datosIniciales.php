<?php


?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Módulo 3 - Datos Iniciales</title>
        <link rel="stylesheet" href="themes/Bootstrap.css">
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
                        <li><a href="flujoVotante.php" rel="external" data-icon="star">Votos</a></li>
                    </ul>
                </div>
            </div>


            <div data-role="content" data-theme="a">
                <h2>Inserta tus datos</h2>

                <div data-role="fieldcontain">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" value=""  />
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
                        <label for="casilla" class="select">Sección:</label>
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

            </div>
            <script type='text/javascript'>
                $(document).bind("pageinit",function()
                {
                    //Si los datos iniciales no han sido seteados entonces
                    //desactiva la TAB de Votos
                    $('#dILoadingSpinner').hide();
                });

                function setData()
                { //Manda los datos al servidor
                    $('#dILoadingSpinner').show();

                    //Checa si es posible habilitar la TAB de Votos

                    window.location = "flujoVotante.php";
                }

            </script>
        </div>
    </body>
</html>
