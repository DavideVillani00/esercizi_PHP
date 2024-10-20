//? COME ACCEDERE AD UN DATABASE CON PDO
//* CREA LE VARIABILI DEL DATABASE
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$databse = "database_prova"

//* BLOCCO TRY-CATCH PER GESTIRE EVENTUALI ERRORI

try{
//* ESEGUI CONNESSIONE
<!-- CREA UNA NUOVA ISTANZA DELLA CLASSE PDO -->
<!-- passi all'interno il tipo di database, in questo caso "mysql:" seguito da host e dbname -->
//! se il database è da creare, ci si collega all'host senza inserire "dbname=..." e crearlo in seguito con una query
$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
//* IMPOSTA IL MODO DI GESTIIONE DEGLI ERRORI
<!-- il primo è l'attributo da cambiare e il secondo è il valore da impostare che ci aiuterà a capire gli errori -->
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//! se devi creare il database crea qui la sql ed eseguila
//! sql="...";
//! $conn->exec($sql);
//* MANDA A SCHERMO IL SUCCESSO
echo "Connessione avvenuta con successo";
//* SE C'è UN ECCEZIONE (ERRORE) MANDA A SCHERMO L'ERRORE
}catch(PDOException $e){
echo "Errore di connessione". $e->getMessage();
}

//*CHIUDI LA CONNESSIONE (LO FA IN AUTOMATICO)
$conn = null;

<?php
// $hostname = "127.0.0.1";
// $username = "root";
// $password = "";
// $database = "esercizi_php_mysql";

// try {
//     $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "connessione avvenuta";
// } catch (PDOException $e) {
//     echo "Errore:" . $e->getMessage();
// }

?>