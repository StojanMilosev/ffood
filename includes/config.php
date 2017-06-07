<?php
    $dbout = parse_url(getenv('DATABASE_URL'));
    return (object) array(
        'db_host'=>$dbout["host"],
        'db_name'=>'heroku_a8fa9b4847b6257',
        'db_username'=>'b08f00a8f7b126',
        'db_password'=>'ddb49660',
        'smtp_host'=>'',
        'smtp_port'=>'',
        'smtp_username'=>'',
        'smtp_password'=>'',
    );
?>
