<?php
function db_config($target)
{
    $param = array();

    $param[''] = array(
        'dsn' => 'mysql:dbname=love;host=localhost', // PDO:db name;host
        'username' => 'root', // user name of database
        'password' => '',// password
        'driver_options' => array(PDO::ATTR_PERSISTENT => false)
    );
    
// postgress config    
//     $param[''] = array(
//         'dsn' => 'pgsql:dbname=nbk;host=localhost',
//         'username' => 'postgres',
//         'password' => '123456',
//         'driver_options' => array(PDO::ATTR_PERSISTENT => false)
//     );

//    sql server config
//     $param['sql_server'] = array(
//         'dsn' => 'sqlsrv:server=HUNGBU-PC\SQLEXPRESS;database=tmpDB',
//         'username' => 'username',
//         'password' => 'password',
//         'driver_options' => array(PDO::ATTR_PERSISTENT => false)
//     );
    
// will call diff database $param[$target];
//     $param['diff_db'] = array(
//         'dsn' => 'pgsql:dbname=cms_indd;host=192.168.1.1',
//         'username' => 'username',
//         'password' => 'password',
//         'driver_options' => array(PDO::ATTR_PERSISTENT => false)
//     );
    return $param[$target];
}