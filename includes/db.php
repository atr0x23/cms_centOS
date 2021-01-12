<?php 




$db['db_host'] = "localhost";
$db['db_user'] = "atr0x_cms_user";
$db['db_pass'] = "@trompoukis1";
$db['db_name'] = "atr0x_cms";


foreach($db as $key => $value){
    
    define(strtoupper($key), $value);
    
}



$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


/* if($connection){
    
    echo "We are connected";
    
} else echo "problem with the connection to database";  */






?>