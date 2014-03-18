<?php

/**
 * Class Tool
 * This is a model to get results
 * 
 * @package Dogs
 * @name Tool.php
 * @author Riadh Hamdi
 * 
*/

class Tool {

    private $maleDogId;
    private $femaleDogId;
    private $DEEP_STOP;
    private $NO_ANCESTOR;
    private $ancestor_dict;
    private $ancestor_dict1;
    private $ancestor_dict2;  
    private $htmlTable;  
    

    /**
    * Class constructor
    *
    * @param int $maleDogId The male id
    * @param int $femaleDogId  The demale id
    * @param int $depth  The depth
    *
    * @return void
    *
    */    
    
    public function __construct($maleDogId, $femaleDogId, $depth) {
        
        $this->maleDogId = intval($maleDogId);
        $this->femaleDogId = intval($femaleDogId);
        
        $this->DEEP_STOP = $depth + 1;
		
        if ($this->DEEP_STOP > 9){
                $this->DEEP_STOP = 9;
        }

        $this->NO_ANCESTOR = array("d0.html", "d.html");
        
        $this->htmlTable = "<table width='1280' border='2'><tbody>";
    }
    

    
    /**
    * Call the function htmlprint_stat to render html
    *
    * @param no params
    *
    * @return void
    *
    */    
    
    public function go() {
        
        $this->htmlprint_stat();        
    }
        
    
    
   /**
    * Render the html result
    *
    * @param no params
    *
    * @return void
    *
    */    
    
    public function htmlprint_stat() {
        
        global $ConfigDogs;

        $serverName = $ConfigDogs->server['name'];
        $defaultValue = $ConfigDogs->data['default_value'];
               
        // Put table header
        $this->htmlTable .="<tr><td bgcolor='#AA0000'><b>ID={$this->maleDogId}+{$this->femaleDogId}</b></td><td><i><u>Name</u></i></td><td><i><u>Gender</u></i></td><td><i><u>Bonitation</u></i></td><td><i><u>Idx H</u></i></td><td><i><u>Idx F</u></i></td><td><i><u>HD</u></i></td><td><i><u>ED</u></i></td><td><i><u>COI5G</u></i></td><td><i><u>Country</u></i></td><td><i><u>Birthday</u></i></td><td><i><u>Breeder</u></i></td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        
        $maleDetails = $this->get_dog_details($this->maleDogId);
        
        $femaleDetails = $this->get_dog_details($this->femaleDogId);
        
        // Put father details
        $this->htmlTable .="<tr><td>&nbsp;</td>
            <td><b><a href='http://www.wolfdog.org/drupal/en/gallery/subcat/1/{$maleDetails['id']}'>{$maleDetails['name']}</a></b></td>
            <td>{$maleDetails["gender"]}</td>
            <td>{$maleDetails["bonitation"]}</td>
            <td>{$maleDetails["indexHeight"]}</td>
            <td>{$maleDetails["indexFormat"]}</td>
            <td>{$maleDetails["hip"]}</td>
            <td bgcolor='{$maleDetails["ed"]["bgcolor"]}'>{$maleDetails["ed"]["value"]}</td>
            <td>{$maleDetails["coi"]}</td>
            <td>{$maleDetails["country"]}</td>
            <td><a href='{$serverName}find_birth.py?year={$maleDetails["birthDay"]}'>{$maleDetails["birthDay"]}</a></td>
            <td><a href='{$serverName}find_breeders.py?name={$maleDetails["allevatore"]["link"]}'>{$maleDetails["allevatore"]["name"]}</a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>";        
             
        // Put mother details            
        $this->htmlTable .="<tr><td>&nbsp;</td>
            <td><b><a href='http://www.wolfdog.org/drupal/en/gallery/subcat/1/{$femaleDetails['id']}'>{$femaleDetails['name']}</a></b></td>
            <td>{$femaleDetails["gender"]}</td>
            <td>{$femaleDetails["bonitation"]}</td>
            <td>{$femaleDetails["indexHeight"]}</td>
            <td>{$femaleDetails["indexFormat"]}</td>
            <td>{$femaleDetails["hip"]}</td>
            <td bgcolor='{$femaleDetails["ed"]["bgcolor"]}'>{$femaleDetails["ed"]["value"]}</td>
            <td>{$femaleDetails["coi"]}</td>
            <td>{$femaleDetails["country"]}</td>
            <td><a href='{$serverName}find_birth.py?year={$femaleDetails["birthDay"]}'>{$femaleDetails["birthDay"]}</a></td>
            <td><a href='{$serverName}find_breeders.py?name={$femaleDetails["allevatore"]["link"]}'>{$femaleDetails["allevatore"]["name"]}</a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>";             
                       
        $deepStop = intval($this->DEEP_STOP - 1);
        
        $this->htmlTable .= "<tr><td bgcolor='#AAAA11'>STATISTIC</td><td>for depth={$deepStop}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        
        $this->htmlTable .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        
        
        
        /*
         * 
        //$DOG_ID_MOTHER = "d{$this->femaleDogId}.html";
	//$DOG_ID_FATHER = "d{$this->maleDogId}.html";
        
        $DOG_ID_MOTHER = $this->femaleDogId;
	$DOG_ID_FATHER = $this->maleDogId;
                                
        $this->ancestor_dict1[0] = $DOG_ID_MOTHER;
        $this->tree_parse1($DOG_ID_MOTHER, 1);
                                
        $this->ancestor_dict2[0] = $DOG_ID_FATHER;
        $this->tree_parse2($DOG_ID_FATHER, 1);
        
        # --- Find common_ancestors
        
        $all_path = array();
        
        foreach ($this->ancestor_dict1 as $deep1 => $value1){
            
                foreach ($this->ancestor_dict1[$deep1] as $i => $dog_key1){

                        foreach ($this->ancestor_dict2 as $deep2 => $value2){
                            
                                foreach ($this->ancestor_dict2[$deep2] as $j => $dog_key2){
                                        if ( ($dog_key1 == $dog_key2) && (!in_array($dog_key2, $this->NO_ANCESTOR)) ){
                                                $buidPath = $this->build_path($deep1, $i, $j, $dog_key1);
                                                array_push($all_path, $buidPath["apath"]);
                                                
                                        }
                                }
                        }
        
                }
        }       
        
        
        
        # --- Remove path
        $final_path = array();

        foreach ($all_path as $apath => $value3){

            $path_ok = True;

            foreach ($all_path as $p => $value4){
                # ca
                if ( $apath[0][$apath[1]-1] == $p[0][$p[1]] && $apath[0][$apath[1]+1] == $p[0][$p[1]]){
                        $path_ok = False;
                        break;
                }
            }

            if($path_ok){
                array_push($final_path, $apath);
            }

        }        
        
        
        # --- coi
        $this->res = array();
        $coi = 0;
        
        foreach ($final_path as $path => $value5){

                $key = $path[0][$path[1]];
                
                $obj_dog = new Dogs();        
                $dog = $obj_dog->get_by_id($key);

                $ca_coi = (float(substr($dog["coi"], 0, -1))/100) + 1;

                $x = pow(0.5, count($path[0])) * $ca_coi;

                if (self.res.has_key(key)){
                        $this->res[$key] += $x;
                }
                else{
                        $this->res[$key] = $x;
                }

                $coi += x;
        }

        $coi *= 100;

        
        
        $new_res = array();
        
        // Todo, vérifier les élements ajouté à au tableau $new_res
        // Class coi_fa.py ligne 317
        foreach ($this->res as $key => $value6){
            array_push($new_res, array($this->res[$key]*100, $key));
        }

        arsort($new_res);
        
        
        //$this->htmlTable .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
        
        $this->htmlTable .= "<tr><td><center><h3><b>COI</b></h3><i><h5>[Sum (1/2)^n1+n2+1 * (1+Fa)]<h5></i></center></td><td><h3><b>{$coi}%</b></h3></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
        
        $this->htmlTable .= "<tr><td>Name</td><td>Mother</td><td>Father</td><td>percent</td><td>Gender</td><td>Birthday</td><td>Bonitation</td><td>Idx H</td><td>Idx F</td><td>HD</td><td>ED</td><td>COI5G</td><td>Country</td><td>Breeder</td></tr>";
        
        $i = 0;
        
        foreach ($new_res as $elem){
            
            $key = $elem[1];
            $percent = $elem[0];
            
            $dogDetails = $this->get_dog_details($key);
            
            $names = array("Lejdy ___Canis Lupus Lupus___", "Brita ___Canis Lupus Lupus___", "Argo ___Canis Lupus Lupus___");
            
            $dogName = $dogDetails["name"];
            
            $hexDogName = '';
            
            for ($i=0; $i < strlen($dogName); $i++){
                $hexDogName .= dechex(ord($dogName[$i]));
            }
            
            $abool = True;
            if( in_array ($dogDetails["name"], $names) || ( $hexDogName = "c5a06172696b205f5f5f43616e6973204c75707573204c757075735f5f5f" ) ){
                $bgColor = "#223366";
                $abool = FALSE;
            }elseif ( strstr($dogName, "F1") || strstr($dogName, "F2") || strstr($dogName, "F3") || strstr($dogName, "F4") || strstr($dogName, "F5") || strstr($dogName, "F6")) {
                $bgColor = "#227766";
                $abool = FALSE;
            }
            
            if( $abool ){
                $bgColor = "#222233";
            }
            
            $motherDogName = $defaultValue;
            if( ! in_array($this->femaleDogId, $this->NO_ANCESTOR) ){
                $obj_dog = new Dogs();        
                $dog = $obj_dog->get_by_id($this->femaleDogId);
                $motherDogName = $dog["nome"];
            }
            
            $fatherDogName = $defaultValue;
            if( ! in_array($this->maleDogId, $this->NO_ANCESTOR) ){
                $obj_dog = new Dogs();        
                $dog = $obj_dog->get_by_id($this->maleDogId);
                $fatherDogName = $dog["nome"];
            }
            
            $gender = ($dogDetails["gender"] != NULL) ? $dogDetails["gender"] : $defaultValue;
            $birthDay = ($dogDetails["birthDay"] != NULL) ? $dogDetails["birthDay"] : $defaultValue;
            $coiBgcolor = ($dogDetails["coi"] != "?" && $dogDetails["coi"] == "0.0000000000%") ? "#7733155" : "";
            
            $this->htmlTable .= "<tr>
                <td bgcolor='{$bgColor}'><a href={$serverName}form.py?id={$key}>{$dogDetails["name"]}</a></td>
                <td><h6><a href={$serverName}form.py?id={$this->femaleDogId}>{$motherDogName}</a></h6></td>
                <td><h6><a href={$serverName}form.py?id={$this->maleDogId}>{$fatherDogName}</a></h6></td>
                <td bgcolor='#222222'><b>{$percent}%</b></td>
                <td>{$gender}</td>
                <td><a href={$serverName}find_birth.py?year={$birthDay}>{$birthDay}</a></td>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td>?</td>
                <td bgcolor='{$dogDetails["ed"]["bgcolor"]}'>{{$dogDetails["ed"]["value"]}</td>
                <td bgcolor='{$coiBgcolor}'>{$dogDetails["coi"]}</td>
                <td>{$dogDetails["country"]}</td>
                <td><a href='{$serverName}find_breeders.py?name={$dogDetails["allevatori"]["Link"]}'>{$dogDetails["allevatori"]["name"]}</a></td>
                </tr>";           
            
        }        
        */
        $this->htmlTable .= "</tbody></table>";
        
    }

    
    
    /**
    * Get the dog details
    *
    * @param int the dog id
    *
    * @return array
    *
    */
    
    public function get_dog_details($dogId) {
        
        global $ConfigDogs;
        // Default value to put
        $defaultValue = $ConfigDogs->data['default_value'];
        
        // Result array
        $dogDetails = array();
        
        $obj_dog = new Dogs();        
        $dog = $obj_dog->get_by_id($dogId);
        
        //var_dump($dogId);
        
        $name = $dog["nome"];
        $id = $dog["id"];
        $gender = (isset($dog['sesso'])) ? str_replace(array("M", "F"), array("Male", "Female"), $dog['sesso']) : $defaultValue;       
        $edArray = array("bgcolor" => "", "value" => $defaultValue);
        
        if( $dog['ed'] != NULL ){            
            $edArray["value"] = $dog['ed'];            
            if ( $dog['ed'] == "0-0" ) {                
                $edArray["bgcolor"] = "#229922";                
            }else{                
                $edArraySplited = explode("-", $dog['ed']);
                if( in_array("3", $edArraySplited) ){
                    $edArray["bgcolor"] = "#992222";
                }elseif ( in_array("2", $edArraySplited) ) {
                    $edArray["bgcolor"] = "#994455";
                }elseif ( in_array("1", $edArraySplited) ) {
                    $edArray["bgcolor"] = "#886622";
                }
            }
        }        
        
        $coi = (isset($dog['coi'])) ? $dog['coi'] : $defaultValue;
        $provenienza = (isset($dog['provenienza'])) ? $dog['provenienza'] : $defaultValue;
        $birthDay = (isset($dog['data_di_nascita'])) ? str_replace("-", ".", $dog['data_di_nascita']) : $defaultValue;
        $allevatori = (isset($dog['allevatore'])) ? $dog['allevatore'] : $defaultValue;
        $allevatoriLink = (isset($dog['allevatore'])) ? str_replace(" ", "%20", $dog['allevatore']) : $defaultValue;
        $allevatoriArray = array("name" => $allevatori, "link" => $allevatoriLink);
        
        $dogDetails["id"] = $id;
        $dogDetails["name"] = $name;
        $dogDetails["gender"] = $gender;
        $dogDetails["bonitation"] = $defaultValue;
        $dogDetails["indexHeight"] = $defaultValue;
        
        $dogDetails["indexFormat"] = $defaultValue;
        $dogDetails["hip"] = $defaultValue;
        $dogDetails["ed"] = $edArray;
        $dogDetails["coi"] = $coi;
        
        $dogDetails["country"] = $provenienza;
        $dogDetails["birthDay"] = $birthDay;
        $dogDetails["allevatore"] = $allevatoriArray;
        
        return $dogDetails;
    }




    /**
    * Build the path
    *
    * @param int $deep the deep
    * @param int $pos1 the primary position
    * @param int $pos2 the second position
    * @param int $cakey the key
    * 
    * @return array
    *
    */

    public function build_path($deep1, $pos1, $pos2, $cakey){

        $apath = array();

        while (1){
                $off = $this->the_off($this->ancestor_dict1, $deep1, $pos1);
                if ($off != -1){
                    array_push($apath, $off);
                    $deep1 -= 1;
                    $pos1 = $pos1 / 2;
                }
                else{
                    array_reverse($apath);
                    break;
                }
        }

        $ca_pos = count($apath);
        
        array_push($apath, $cakey);

        while(1){
                $off = $this->the_off($this->ancestor_dict2, $$deep2, pos2);
                if ($off != -1){
                    array_push($apath, $off);
                    $deep2 -= 1;
                    $pos2 = $pos2 / 2;
                }
                else{
                        break;
                }
        }        

        return array("apath" => $apath, "ca_pos" => $ca_pos);
    }
    
    
    /**
    * Check the dog ancestor
    *
    * @param int $adict the ancestor
    * @param int $deep the deep
    * @param int $pos the position
    * 
    * @return array
    *
    */
    
    public function the_off($adict, $deep, $pos){
        
        if($deep-1 != 0)
            return $adict[$deep-1][$pos/2];
        else
            return (-1);
    }
    
    
    /**
    * Get the html result
    *
    * @param no params
    * 
    * @return string $this->htmlTable
    *
    */    
    
    public function get_result(){            
                
        return $this->htmlTable;

    }
    
    
    
    /**
    * Parse the ancestor
    *
    * @param int $node_key the dog id
    * @param int $deep the deep
     * 
    * @return void
    *
    */    
    
    public function tree_parse($node_key, $deep){
        
        if ( $deep == $this->DEEP_STOP )
                return;

        try{
                # mother
                $obj_dog = new Dogs();        
                
                $dog = $obj_dog->get_by_id($node_key );
                $mkey = isset($dog) ? $dog['madre'] : "d0.html";

                if (array_key_exists(($deep+1), $this->ancestor_dict))
                    $this->ancestor_dict[$deep+1] = array($mkey);
                else
                    $this->ancestor_dict[$deep+1] = $mkey;

                $this->tree_parse($mkey, $deep+1);

                # father                
                $fkey = isset($dog) ? $dog['padre'] : "d0.html";

                if (array_key_exists(($deep+1), $this->ancestor_dict))                    
                    $this->ancestor_dict[$deep+1] = array($fkey);
                else
                    $this->ancestor_dict[deep+1] = $fkey;

                $this->tree_parse($fkey, $deep+1);                
                
            }
            
            catch (Exception $e) {
                $this->exec_detail($e);
            }
            
                
        }       
        
        
        
    
        /**
        * Parse the ancestor
        *
        * @param int $node_key the dog id
        * @param int $deep the deep
         * 
        * @return void
        *
        */         
        
        public function tree_parse1($node_key, $deep){
            
            if ( $deep == $this->DEEP_STOP )
                return;

            try{
                
                $obj_dog = new Dogs();
                
                # mother                
                $dog = $obj_dog->get_by_id($node_key);
                
                $mkey = isset($dog) ? $dog['madre'] : "d0.html";

                if ( array_key_exists(($deep+1), $this->ancestor_dict1) )
                    $this->ancestor_dict1[$deep+1] = array($mkey);
                else
                    $this->ancestor_dict1[$deep+1] = $mkey;

                $this->tree_parse1($mkey, $deep+1);

                # father                
                $fkey = isset($dog) ? $dog['padre'] : "d0.html";   

                if (array_key_exists(($deep+1), $this->ancestor_dict1))                    
                    $this->ancestor_dict1[$deep+1] = array($fkey);
                else                    
                    $this->ancestor_dict1[deep+1] = $fkey;

                $this->tree_parse1($fkey, $deep+1);
            }
            
            catch (Exception $e) {
                $this->exec_detail($e);
            }
            
                
        }        
        
        
        
        
    
        /**
        * Parse the ancestor
        *
        * @param int $node_key the dog id
        * @param int $deep the deep
         * 
        * @return void
        *
        */         
        public function tree_parse2($node_key, $deep){
            
            if ( $deep == $this->DEEP_STOP )
                return;

            try{
                
                $obj_dog = new Dogs();
                
                # mother                
                $dog = $obj_dog->get_by_id($node_key);
                
                $mkey = isset($dog) ? $dog['madre'] : "d0.html";            

                if (array_key_exists(($deep+1), $this->ancestor_dict2))
                    // Todo
                    $this->ancestor_dict2[$deep+1] = array($mkey);
                else
                    // Todo
                    $this->ancestor_dict2[$deep+1] = $mkey;

                $this->tree_parse2($mkey, $deep+1);

                # father                
                $fkey = isset($dog) ? $dog['padre'] : "d0.html";

                if (array_key_exists(($deep+1), $this->ancestor_dict2))                        
                    $this->ancestor_dict2[$deep+1] = array($fkey);
                else
                    $this->ancestor_dict2[deep+1] = $fkey;

                $this->tree_parse2($fkey, $deep+1);
            }
            
            catch (Exception $e) {
                $this->exec_detail($e);
            }
            
                
        }
        
        public function exec_detail($e){
            print "Content-Type: text/html\n";
            print "Exception code='{$e->getCode()}', from file='{$e->getFile()}', line number='{$e->getLine()}', trace='{$e->getTraceAsString()}',function='{__FUNCTION__}' code line='{__LINE__}'";
        }

}

// END CLASS CODE

?>
