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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Módulo 3</title>
		<link rel="stylesheet" href="themes/Bootstrap.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	</head>
	<body>
		<div data-role="page" data-theme="a">
			<div data-role="header" data-position="inline">
				<h1>Módulo 3</h1>
				
			</div>
			<div data-role="content" data-theme="a">
                                <h2>Bienvenido</h2>

				<form action="#" method="get">
				<div data-role="fieldcontain">
						<label for="user">Usuario:</label>
						<input type="text" name="user" id="user" value=""  />
					</div>
                                    
                                    <div data-role="fieldcontain">
						<label for="pass">Usuario:</label>
                                                <input type="password" name="pass" id="name" value=""  />
					</div>
                                    
                                    <fieldset class="ui-grid-a">
							
							<div class="ui-block-b"><button type="submit" data-theme="a">Ingresa</button></div>
					    </fieldset>
                                
                                </form>
			</div>
		</div>
	</body>
</html>
