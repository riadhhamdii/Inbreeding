<?php
  /*  
    $host = 'localhost'; // Your database host
    $user = 'root'; // Your database username
    $password = ''; // Your database password
    $name = 'dogs'; // Your database name
  */  
    
global $ConfigDogs;

if (!isset($ConfigDogs)) {
	$ConfigDogs = new stdClass;
}

// Database parameters
$ConfigDogs->db['host'] = "localhost";
$ConfigDogs->db['user'] = "root";
$ConfigDogs->db['password'] = "/Li&Po1123";
$ConfigDogs->db['db_name'] = "dogs";

// Server
$ConfigDogs->server['name'] = "http://www.amicale-chien-loup-tchecoslovaque.com/cgi-bin/";

// Default of empty value
$ConfigDogs->data['default_value'] = "?";

?>
