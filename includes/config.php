<?php
    //databse credentials
    $db_host = getenv('DB_HOST');
    $db_name = getenv('DB_NAME');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASS');
    //smtp credentials
    $smtp_host = getenv('SMTP_HOST');
    $smtp_name = getenv('SMTP_NAME');
    $smtp_port = getenv('SMTP_PORT');
    $smtp_user = getenv('SMTP_USER');
    $smtp_pass = getenv('SMTP_PASS');
    return (object) array(
        'db_host'=>$db_host,
        'db_name'=>$db_name,
        'db_username'=>$db_user,
        'db_password'=>$db_pass,
        'smtp_host'=>$smtp_host,
        'smtp_port'=>$smtp_port,
        'smtp_username'=>$smpt_name,
        'smtp_password'=>$smtp_pass,
    );
?>
