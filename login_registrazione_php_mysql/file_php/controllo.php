<?php
include "./connessione.php";

// variabili input
$nome = $_POST['nome'];
$email = $_POST['email'];
$password = $_POST['password'];
$ripeti_password = $_POST['ripeti_password'];

// controllo input in modo basilare
if (strlen($nome) < 3 || is_numeric($nome) || $nome = "" || preg_match("/\d+/", $nome)) {
    die("inserisci un nome valido");
}
if (!preg_match("/^[\w.-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/", $email)) {
    die("inserisci una mail valida");
}
if ($password === "" || strlen($password) < 3) {
    die("inserisci una password più sicura");
}
if ($password !== $ripeti_password) {
    die("le password non coincidono");
}
























$conn->close();
