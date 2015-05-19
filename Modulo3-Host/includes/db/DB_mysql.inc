<?php

//Clase para comunicacion con MySQL
//Los metodos se han simplificado para el manejo de conexiones
class DB_mysql {
    /* variables de conexión */

    var $Database;
    var $Host;
    var $User;
    var $Password;

    /* identificador de conexión y consulta */
    var $Connection_ID = 0;
    var $Query_ID = 0;



    /* número de error y texto error */
    var $Errno = 0;

    /* Método Constructor: Cada vez que creemos una variable

      de esta clase, se ejecutará esta función */

    function DB_mysql($bd = "citalinc_modulo3", $host = "localhost", $user = "citalinc_hmojica", $pass = "\$nQZh\$lByTmB") {

        $this->Database = $bd;

        $this->Host = $host;

        $this->User = $user;

        $this->Password = $pass;
    }

    /* Conexión a la base de datos */

    function openConnection() {
        // Conectamos al Host
        $this->Connection_ID = mysqli_connect($this->Host, $this->User, $this->Password);

        if (!$this->Connection_ID) {
            $this->Error = "Error opening connection.";
            return 0;
        }
        //seleccionamos la base de datos
        if (!@mysqli_select_db($this->Connection_ID, $this->Database)) {
            $this->Error = "Error opening database " . $this->Database;
            return 0;
        }
        /* Si hemos tenido éxito conectando devuelve
          el identificador de la conexión, sino devuelve 0 */
        return $this->Connection_ID;
    }

    /* Cierra la conexion */

    function closeConnection() {
        return @mysqli_close($this->Connection_ID);
    }

    /* Establece el autocommit, para manejar manualmente las transacciones */

    function setAutocommit($par) {

        return @mysqli_autocommit($this->Connection_ID, $par);
    }

    /* Compromete la transaccion */

    function commit() {
        return @mysqli_commit($this->Connection_ID);
    }

    /* Deshace la transaccion */

    function rollback() {
        return @mysqli_rollback($this->Connection_ID);
    }

    /* Executes a Stored Procedure
     * $sp		is the name of the Stored Procedure
     * $args            is an array with all the arguments to pass in
     * $isNonQuery      points if we expect a ResultSet in return (false - default - SELECTS...) or not (true - INSERTS, UPDATES)
     * i.e. 
     * $args = array('cat','dog');
     * executeStoredProcedure("sp_mecanico", $args)
     * 
     * return	The result set with the information if is a query and everything was good.
     *          If $isNonQuery = true, then it returns "OK"
     *          If the no Stored Procedure passed in or $args is not valid, returns null
     * */

    function executeStoredProcedure($sp, $args, $isNonQuery = false) {
        if ($sp != "" && is_array($args)) {
            $query = "CALL " . $sp;
            if (count($args) > 0) {
                $query .= "(";
                foreach ($args as $arg) {
                    $query .= "'";
                    $query .= $arg;
                    $query .= "',";
                }
                //Delete last comma and adding the query termination
                $query = substr($query, 0, -1);
                $query .= ");";
            } else {//If it doesnt have extra params.
                $query .= "();";
            }
            //Executes de query
            $db = new DB_mysql;
            $db->openConnection();
            $db->executeQuery($query);
            if($isNonQuery)
                $rs = "OK";
            else
                $rs = $db->getResultSet();
            
            return $rs;
        }
        return null;
    }

    /* Ejecuta un consulta del tipo select */

    function executeQuery($sql = "") {



        if ($sql == "") {

            $this->Error = "No ha especificado una consulta SQL";

            return 0;
        }



        //ejecutamos la consulta

        $this->Query_ID = @mysqli_query($this->Connection_ID, $sql);



        if (!$this->Query_ID) {

            $this->Errno = mysqli_errno($this->Connection_ID);

            $this->Error = mysqli_error($this->Connection_ID);
        }

        /* Si hemos tenido éxito en la consulta devuelve

          el identificador de la conexión, sino devuelve 0 */

        return $this->Query_ID;
    }

    /* Ejecuta un query de modificacion, insert,delete, update */

    function executeUpdate($sql = "") {


        if ($sql == "") {

            $this->Error = "No ha especificado una consulta SQL";

            return 0;
        }



        //ejecutamos la consulta
        $stmt = mysqli_prepare($this->Connection_ID, $sql);

        $v = @mysqli_stmt_execute($stmt);

        @mysqli_stmt_close($stmt);


        return mysqli_insert_id($this->Connection_ID) + $v;
    }

    /* Devuelve el número de campos de una consulta */

    function getNumFields() {

        return mysqli_num_fields($this->Query_ID);
    }

    /* Devuelve el número de registros de una consulta */

    function getNumRows() {

        return mysqli_num_rows($this->Query_ID);
    }

    /* Devuelve el nombre de un campo de una consulta */

    function getFieldNames() {

        return $this->Query_ID->fetch_fields();
    }

    /* Obtiene la matriz de metadatos de una consulta */

    function getResultSetMetaData() {
        $metadata = array();
        for ($i = 0; $i < $this->getNumFields(); $i++) {

            $metadata[$i] = $this->getFieldName($i);
        }
        return $metadata;
    }

    /* Obtiene la matriz de datos de una consulta */

    function getResultSet() {

        $row_number = 0;
        $resultset = array();
        while ($row = mysqli_fetch_row($this->Query_ID)) {
            for ($i = 0; $i < $this->getNumFields(); $i++) {
                $resultset[$row_number][$i] = $row[$i];
            }
            $row_number++;
        }
        return $resultset;
    }

}

//end class
?>
