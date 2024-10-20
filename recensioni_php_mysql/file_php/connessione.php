<!-- !! da creare la connessione, 3 tabelle (ristoranti (id nome descrizione id_recensione), recensioni (prende id tabella ristoranti (id stelle recensione data)) e utenti registrati["puoi usare quella vecchia"]) -->


<?php
//costanti di connessione database
define("HOSTNAME", "127.0.0.1");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "esercizi_php_mysql");


$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($conn->errno) {
    echo $conn->error;
}
