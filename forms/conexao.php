<?php
//Credenciais de acesso ao BD
define('HOST', 'localhost:3307');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'meuBanco');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

