<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Módulo 3</title>
        <link rel="stylesheet" href="themes/Bootstrap.min.css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
        <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="IndexPage" data-role="page" data-theme="a">
        <div data-role="header" data-position="inline">
                <h1>Módulo 3</h1>
        </div>
            
        <div data-role="content" data-theme="a">
            <h2>Bienvenido</h2>

            <form action="#" method="get">
                <div data-role="fieldcontain">
                    <label for="iUser">Usuario:</label>
                    <input type="text" name="iUser" id="iUser" value=""  />
                </div>

                <div data-role="fieldcontain">
                    <label for="iPass">Password:</label>
                    <input type="password" name="iPass" id="iPass" value=""  />
                </div>

                <fieldset class="ui-grid-a">
                    <div class="ui-block-b"><button type="button" onclick="doLogin();" data-theme="a">Ingresa</button></div>
                </fieldset>

            </form>

            <div align="center" id = 'indexLoadingSpinner'><i class="fa fa-spinner fa-spin fa-3x"></i></div>
            <div style="text-align: center;" id="divError" class="alert alert-danger" role="alert"></div>

        </div>
        </div>
        <script type='text/javascript'>

            //Este es como el $(document).ready
            $(document).bind("pageinit",function()
            {
                $('#indexLoadingSpinner').hide();
                $('#divError').hide();
            });
            
            function doLogin()
            {
                $("#indexLoadingSpinner").show();
                $("#divError").hide();
        
                $.ajax({
                    type: "POST",
                    url: "index_login.php",
                    dataType: "html",                       //Data waited in return from server
                    data:                                       //Data sent to the server
                    {
                        usr : $("#iUser").val(),
                        pass: $("#iPass").val()
                    },
                    success:
                        function(data)
                        {
                            $("#indexLoadingSpinner").hide();
                            window.location = "datosIniciales.php";
                        },
                    error:
                        function()
                        {
                            $("#indexLoadingSpinner").hide();
                            $('#divError').show();
                            $("#divError").html("Error de conexión");
                        }
                });
            }
            
        </script>
    </body>
</html>
