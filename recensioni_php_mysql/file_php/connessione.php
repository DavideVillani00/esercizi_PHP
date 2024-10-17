<!-- !! da creare la connessione, 3 tabelle (ristoranti (id nome descrizione id_recensione), recensioni (prende id tabella ristoranti (id stelle recensione data)) e utenti registrati["puoi usare quella vecchia"]) -->


<?php
//variabili di connessione database
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "esercizi_php_mysql";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->errno) {
    echo $conn->error;
}
