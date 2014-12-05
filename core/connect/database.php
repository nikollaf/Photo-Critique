<?php

$config = array(
    'host'		=> 'localhost',
    'username' 	=> 'root',
    'password' 	=> 'albania1',
    'dbname' 	=> 'worldlens_db'
);

function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="albania1";
    $dbname="worldlens_db";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
$config = array(
	'host'		=> 'world-lens.mysql.eu1.frbit.com',
	'username' 	=> 'world-lens',
	'password' 	=> 'hqW16rCFtABC86ub',
	'dbname' 	=> 'world-lens'
);

function getConnection() {
    $dbhost="world-lens.mysql.eu1.frbit.com";
    $dbuser="world-lens";
    $dbpass="hqW16rCFtABC86ub";
    $dbname="world-lens";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/