<?php

class Database{
	var $conn,$Host, $User, $Password,$Name;
	
         /*
             * @return boolean
             * @param String $host
             * @param String $user
             * @param String $password
             * @param String $name
             * @desc Costruttore della classe Database
         */         
         function Database($host,$user,$password,$name){
		$this->Host = $host;
		$this->User = $user;
		$this->Password = $password;
		$this->Name = $name;
	}


        /*
            * @return void
            * @desc Connette al database
        */
        
	function connetti(){
		$this->conn = mysql_connect($this->Host,$this->User,$this->Password) or die('Impossibile connettersi al database');
		mysql_select_db($this->Name,$this->conn) or die('Impossibile selezionare il database');
	}
	
         
        /*
            * @return resource
            * @param String $query
            * @desc Esegue una query
        */
	function query($query){
		//echo $query.'<br>';
                mysql_query('set names utf8', $this->conn);
		$sql = mysql_query($query,$this->conn);
                 if($sql == false){
                     return false;
                 }else{
                     return $sql;
                 }		
	}

        /*
            * @return array
            * @param resource $query_eseguita
            * @desc Restituisce il risultato della query
        */
         function fetch_array($query_eseguita) {
             $rs = mysql_fetch_array($query_eseguita);
			 if ($rs == false){
			 	return false;
			 }else{
			 	return $rs;
			 }
        }


	/*
	 * @return int
	 * @desc Resittuisce il numero dei record coinvolti nell'ultima query
	 */
	function numRows(){
		$numrows = mysql_affected_rows($this->conn);
		return $numrows;
	}

	/*
	 * @return int
	 * @desc Restituisce l'ultimo id inserito
	 */
	function last_id(){
		$id = mysql_insert_id();
		return $id;
	}

	/*
	 * @return void
	 * @desc Chiude la connessione al database
	 */
	function close(){
		mysql_close($this->conn);
	}
}
?>
