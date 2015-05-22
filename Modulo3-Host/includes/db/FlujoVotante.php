<?php

class FlujoVotante
{
    private $userName;      //user logueado
    private $nombreRMDC;    //Nombre RMDC introducido
    private $seccion;       //ID de la Seccion
    private $tipoCasilla;   //ID del tipo de casilla
    private $LND;           //el LND del votante
    private $coordenadas;   //Coordenadas del RMDC
    
    //Constructor principal de la clase
    function __construct($userName_ = '', $nombreRMDC_ = '', $seccion_ = '', $tipoCasilla_ = '', $LND_ = '', $coordenadas_ = '')
    {
        $this->userName     = $userName_;
        $this->nombreRMDC   = $nombreRMDC_;
        $this->seccion      = $seccion_;
        $this->tipoCasilla  = $tipoCasilla_;
        $this->LND          = $LND_;
        $this->coordenadas  = $coordenadas_;
    }
    
    function getUserName() {
        return $this->userName;
    }

    function getNombreRMDC() {
        return $this->nombreRMDC;
    }

    function getSeccion() {
        return $this->seccion;
    }

    function getTipoCasilla() {
        return $this->tipoCasilla;
    }

    function getLND() {
        return $this->LND;
    }

    function getCoordenadas() {
        return $this->coordenadas;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setNombreRMDC($nombreRMDC) {
        $this->nombreRMDC = $nombreRMDC;
    }

    function setSeccion($seccion) {
        $this->seccion = $seccion;
    }

    function setTipoCasilla($tipoCasilla) {
        $this->tipoCasilla = $tipoCasilla;
    }

    function setLND($LND) {
        $this->LND = $LND;
    }

    function setCoordenadas($coordenadas) {
        $this->coordenadas = $coordenadas;
    }

    //Intenta insertar el Voto en la base de datos
    //Regresa 'ALREADY' si el LND ya estaba registrado
    //Regresa 'ADDED' si el LND fue insertado a la BD
    public static function insertVoto($flujoVotante)
    {
        //call sp_insertVoto ('admin','Haza','0','0','123','')
    	$sp     = "sp_insertVoto";
    	$args   = array($flujoVotante->getUserName(), 
                        $flujoVotante->getNombreRMDC(),
                        $flujoVotante->getSeccion(),
                        $flujoVotante->getTipoCasilla(),
                        $flujoVotante->getLND(),
                        $flujoVotante->getCoordenadas()
                    );
    	$rs     = DB_mysql::executeStoredProcedure($sp, $args);
    	$result = null;
    	if (count($rs) > 0)
    	{
            $result = $rs[0][0];
    	}
    	return $result;
    }
    
}

?>