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


// controlla che ci sia il token
if (isset($_COOKIE['ricordami'])) {
    $token = $_COOKIE['ricordami'];
}
// recupera l'id che ha quel token
$sql = 'SELECT id FROM utenti_registrati WHERE cookie_loggato = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
// scegli dove salvare il risultato
$stmt->bind_result($id);
// scarichi il risultato nella variabile impostata
$stmt->fetch();
$stmt->close();
if ($id) {
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['loggato'] = true;
}
