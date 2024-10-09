<?php

$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'esercizi_php_mysql';

// crea connessione

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->errno) {
    die("errore nella connessione: " . $conn->error);
}
