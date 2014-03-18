<?php

/**
 * Class Dogd
 * This is a model to manage Dog
 * 
 * @package Dogs
 * @name Tool.php
 * @author Riadh && Claudio
 * 
*/


class Dogs {

    private $mConn;

    public function __construct() {
        
        global $ConfigDogs;
        
        $db = new Database($ConfigDogs->db['host'], $ConfigDogs->db['user'], $ConfigDogs->db['password'], $ConfigDogs->db['db_name']);
        $db->connetti();
        $this->mConn = $db;
    }
    
    public function __destruct() {
        
        if( $this->mConn instanceof Database){
            $this->mConn->close();
        }
    }
    
    public function get_males() {
        
        $query = "SELECT id, nome, registro FROM cani WHERE sesso='M' ORDER BY nome; ";
        $exec = $this->mConn->query($query);
        $m = 0;
        while ($rs = $this->mConn->fetch_array($exec)) {
            $maschio[$m]['id'] = $rs['id'];
            $maschio[$m]['nome'] = stripslashes(html_entity_decode($rs['nome'], ENT_QUOTES, 'UTF-8'));
            $maschio[$m]['registro'] = $rs['registro'];
            $m++;
        }
        if (isset($maschio)) {
            return $maschio;
        }
    }

    public function get_females() {
        
        $query = "SELECT id, nome,registro FROM cani WHERE sesso='F' ORDER BY nome; ";
        $exec = $this->mConn->query($query);
        $f = 0;
        while ($rs = $this->mConn->fetch_array($exec)) {
            $femmina[$f]['id'] = $rs['id'];
            $femmina[$f]['nome'] = stripslashes(html_entity_decode($rs['nome'], ENT_QUOTES, 'UTF-8'));
            $femmina[$f]['registro'] = $rs['registro'];
            $f++;
        }
        if (isset($femmina)) {
            return $femmina;
        }
    }

    
    
    public function get_by_id($dogId) {
        
        if( !is_int($dogId) ){
            return NULL;
        }
        
        $query = "SELECT A.id, A.nome, sesso, A.data_di_nascita, A.madre, A.padre, A.coi, A.provenienza, A.hd, A.ed, A.dm, B.nome as allevatore";
        $query .= " FROM cani A JOIN allevatori B";
        $query .= " ON (A.allevatore = B.id)";        
        $query .= " WHERE A.id={$dogId}";
        $query .= " LIMIT 1; ";
        
        $exec = $this->mConn->query($query);
        while ($rs = $this->mConn->fetch_array($exec)) {
            
            $dog['id'] = $rs['id'];
            $dog['nome'] = stripslashes(html_entity_decode($rs['nome'], ENT_QUOTES, 'UTF-8'));
            $dog['sesso'] = $rs['sesso'];
            $dog['data_di_nascita'] = $rs['data_di_nascita'];
            
            $dog['padre'] = $rs['padre'];
            $dog['madre'] = $rs['madre'];           
            $dog['coi'] = $rs['coi'];
            $dog['provenienza'] = $rs['provenienza'];
            
            $dog['hd'] = $rs['hd'];           
            $dog['ed'] = $rs['ed'];
            $dog['dm'] = $rs['dm'];
            $dog['allevatore'] = $rs['allevatore'];
            
        }
        
        if (isset($dog)) {
            return $dog;
        }
        
        return NULL;

    }
    
    
    
    
   
    
    public function get_ancestor($dogId, $gender) {
        
        if( !is_int($dogId) || ($gender != "padre") || ($gender != "madre") ){
            return NULL;
        }
        
        $query = "SELECT {$gender}";
        $query .= " FROM cani";
        $query .= " WHERE id={$dogId}";
        $query .= " LIMIT 1; ";
        
        $exec = $this->mConn->query($query);
        $rs = $this->mConn->fetch_array($exec);
               
        if (isset($rs)) {
            return $rs[$gender];
        }
        
        return NULL;

    }   
        
        
    
}

?>
