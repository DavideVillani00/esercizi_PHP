<?php

// creazione delle variabili per la connesione
$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'esercizi_php_mysql';

// stabilire una connesione
$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->errno) {
    die("impossibile connettersi al database" . $conn->error);
}
