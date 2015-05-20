<?php

if(PHP_OS == "WINNT")
{
    /*Windows Includes*/
    require_once dirname(__FILE__).'\DB_mysql.php';
}
else
{
    /*Unix / Linux includes*/
    require_once dirname(__FILE__).'/DB_mysql.php';
}

class Usuario
{
    //put your code here
    private $userName;
    private $pass;
    
    
    public function getPass() {
        return $this->pass;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }
    
    public function setPass($pass) {
        $this->pass = $pass;
    }
    
    //Lee la informacion del usuario de la DB
    //y regresa una instancia de la esta clase
    //null si no encoontro datos
    public static function getUser($userName)
    {
    	$sp = "sp_getUser";
    	$args = array($userName);
    	$rs = DB_mysql::executeStoredProcedure($sp, $args);
    	$user = null;
    	if (count($rs) > 0)
    	{
            $user = new Usuario();
            $user->setUserName($rs[0][0]);
            $user->setPass($rs[0][1]);
    	}
    	return $user;
    }
    
}

?>