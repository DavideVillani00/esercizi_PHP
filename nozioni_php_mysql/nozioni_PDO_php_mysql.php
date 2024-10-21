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

//* CHIUDI LA CONNESSIONE (LO FA IN AUTOMATICO)
$conn = null;

//? COME INSERIRE, LEGGERE, MODIFICARE E CANCELLARE I DATI CON PDO
//*CONNETTITI AL DATABASE (USO LE VARIABILI GIà CREATE IN PRECEDENZA)
try{
$conn-> new PDO("mysql:host=$hostname;dbname=$database, $username, $password");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//! PER INSERIRE DATI
//* CREI LA QUERY
<!-- utilizza la dicitura ":" seguito dal nome del valore per far capire il parametro da passare -->
$sql = "INSERT INTO utenti (nome, cognome) VALUE (:nome, :cognome)";
//* PREPARI LA QUERY
$stmt = $conn->prepare($sql);
//* IMPOSTA I PARAMETRI NELLE VARIABILI
<!-- per evitare gli sql injiected -->
$nome = "Marco";
$cognome = "Marzotto";
//* ESEGUI IL CAMBIO PER OGNI VALORE DA PASSARE
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":cognome", $cognome);
//*ESEGUI LA QUERY
$stmt->execute();
//!

//! PER LEGGERE I DATI
//* CREI LA QUERY
$sql = "SELECT * FROM utenti";
//* PREPARI LA QUERY
$stmt = $conn->prepare($sql);
//* ESEGUI LA QUERY
$stmt->execute();
//* PRENDI I RISULTATI
<!-- salvi il risultato in un array associativo chiamato $utenti -->
$utenti = $stmt->fetchAll(PDO::FETCH_ASSOC);
//* FAI QUELLO CHE DEVI, ES STAMPA IL RISULTATO
foreach ($utenti as $utente){
<!-- utilizza htmlspecialchars() per poter evitare che il browser esegua codice html o js in caso qualcuno l'abbia inserito nel database -->
<!-- htmlspecialchars($variabile, ENT_QUOTES); il secondo parametro serve per codificare anche le virgolette signole e doppie -->
echo htmlspecialchars($utente["nome"], ENT_QUOTES). " ". htmlspecialchars($utente["cognome"], ENT_QUOTES). "<br>";
}
//!

//! PER MODIFICARE I DATI
//* CREI LA QUERY
$sql = "UPDATE utenti SET nome = :nome, cognome = :cognome WHERE id = :id";
//* PREPARI LA QUERY
$stmt = $conn->prepare($sql);
//* ESEGUI IL bindParam
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":cognome", $cognome);
$stmt->bindParam(":id", $id);
//* ESEGUI LA QUERY
$stmt->execute();
//!

//! PER ELIMINARE I DATI
//* CREI LA QUERY
$sql = "DELETE FROM utenti WHERE id = :id";
//* PREPARI LA QUERY
$stmt = $conn->prepare($sql);
//* ESEGUI IL bindParam
$stmt->bindParam(":id", $id);
//* ESEGUI LA QUERY
$stmt->execute();
//!

}catch(PDOException $e){
echo "Errore:" $e->getMessage();
}