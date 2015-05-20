<?php

/* Esta clase estática esta diseñada para contener todas las funciones
 * genéricas para el buen funcionamiento del sitio.
 * Por funciones genéricas me refiero a todo aquello que puede ser usado
 * en todo el sitio sin necesidad de configuración específica.
 * Como:
 * Mandar mails.
 * Hacer Login o Registro Simple, Cerrar Sesión.
 **/

if(PHP_OS == "WINNT")
{
    /*Windows Includes*/
    require_once dirname(dirname(__FILE__)).'\db\Usuario.php';
    require_once dirname(dirname(__FILE__)).'\db\DB_mysql.php';
}
else
{
    /*Unix / Linux includes*/
    require_once dirname(dirname(__FILE__)).'/db/Usuario.php';
    require_once dirname(dirname(__FILE__)).'/db/DB_mysql.php';
}
tools::startSession();

class tools
{
    public static function startSession($forceStart = false)
    {   
        if( (tools::is_session_started() === false)  || $forceStart)
            session_start();
    }
    
    //Regresa True si existe algun usuario logueado
    //Falso si no.
    public static function isUserLogged()
    {
            $isLogged = false;
            $user = tools::getLoggedUser();

            if($user != null)
                $isLogged = true;

            return $isLogged;
    }

    //Regresa el Usuario Logueado o Null si no existe sesion 
    public static function getLoggedUser()
    {
        $user = null;
        if(isset($_SESSION['loggedUser']))
        {
            $user = unserialize($_SESSION['loggedUser']);
        }
        return $user;
    }

    public static function destroySession()
    {
        // Unset all of the session variables.
        $_SESSION = array();
        // Finally, destroy the session.
        session_destroy();
    }

    //****************************************************
    //Hay que tratar de que esta función estática se use siempre al mandar mails
    //para así centralizar las operaciones de envío de mails en esta parte
    //del framework.
    //Return: true si el mail fue enviado correctamente y false otherwise
    public static function sendMail($mailTo, $subject = "No Reply BUME", $txt = "Saludos desde BuenosMecánicos.com")
    {
        $mailBody .= "<html><body>";
        $mailBody .= $txt;//Adjunta el mensaje que se quiere mandar
        $mailBody .= "<br><hr>";//Agrega un buen footer
        $mailBody .= "<small>Este mensaje es privado y fue enviado dede BuenosMecanicos.com, si por alguna razón";
        $mailBody .= "crees que te ha llegado por error por favor repórtalo a admin@buenosmecanicos.com</small>";
        $mailBody .= "</body></html>";
        
        //Configura el FROM y Reply To
        $headers = "From: noreply@buenosmecanicos.com". "\r\n";
        $headers .= "Reply-To: admin@buenosmecanicos.com" . "\r\n";
        //Permitir formato HTML en el mail
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        //ENVIA EL MAIL
        //**********************************************************************
        $ok = mail($mailTo,$subject,$mailBody,$headers);
        //**********************************************************************
        
        if(!$ok)//Si algo NO sucedió bien, ponlo en el log
            error_log ("Error mandando mail. ".$txt, 0);
        
        return $ok;
    }
    
    public static function is_session_started()
    {
        if ( php_sapi_name() !== 'cli' )
        {
            if ( version_compare(phpversion(), '5.4.0', '>=') )
            {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            }
            else
            {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }
    
    public static function login($user_, $pass_)
    {
        $user = Usuario::getUser($user_);
        if($user != null)
        {
            if($user->getPass() == $pass_)
            {
                tools::loginImpl($user);
            }
            else
            {
                $user = new Usuario();
                $user->setUserName("**NoUser-Pass**");
            }
        }
        return $user;
    }

    /*Realiza el login
     * $user es una instancia de la clase Usuario : Usuario.inc.php
     * ***/
    public static function loginImpl($user)
    {
        tools::destroySession();
        //Get new Session
        session_start();

        //Set loggedUser
        $_SESSION['loggedUser'] = serialize($user);
        $_SESSION["logged"] = true;
    }

}

?>