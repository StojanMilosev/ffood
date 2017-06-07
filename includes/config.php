<?php
    $host = getenv('DB_HOST');
    $name = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    return (object) array(
        'db_host'=>$host,
        'db_name'=>$name,
        'db_username'=>$user,
        'db_password'=>$pass,
        'smtp_host'=>'',
        'smtp_port'=>'',
        'smtp_username'=>'',
        'smtp_password'=>'',
    );
?>
