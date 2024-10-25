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
$stmt->bindParam(":nome", $nome);               //*OPPURE ESEGUI PASSANDO VALORI
$stmt->bindParam(":cognome", $cognome);         / $stmt->execute([":nome" => $nome, ":cognome => $cognome"])
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
$utenti = $stmt->fetchAll(PDO::FETCH_ASSOC);                                    //*SE C'è SOLO UN RISULTATO PUOI USARE SOLO FETCH 
                                                                                / $risultato = $stmt->fetch(PDO::FETCH_ASSOC);
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
//* ESEGUI IL bindParam                                     oppure esegui passando i parametri
$stmt->bindParam(":nome", $nome);                            $stmt->execute([":nome"=>$nome, ":cognome"=>$cognome, ":id"=>$id]);
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

//? COME SANITIZZARE I DATI PRESI DA INPUT UTENTE
//* trim(), stripslashes(), htmlspecialchars()
//! puoi includerli in una funzione che chiamerai ad ogni input inserito
function sanitizzaInput($el){
$el = trim($el);
$el = stripslashes($el);
$el = htmlspecialchars($el, ENT_QUOTES);
return $el;
}
//*sanitizza l'input del nome tramite la funzione
$nome = sanitizzaInput($_POST["nome"]);
//! per le email è sempre consigliato fare una sanitizzazione aggiuntiva con filter_var()
$email = filter_var(sanitizzaInput($_POST["email"]), FILTER_SANITIZE_EMAIL);

//? QUANDO SALVI UNA PASSWORD SUL DATABASE USA L'HASHING PER RENDERLA SICURA
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
//*per verificare che la password inserita nel login sia corretta con quella del database usa password_verify()
if(password_verify($_POST["password"], <!-- QUI VA LA password nel database -->)){
    echo "benvenuto";
}else{
    echo "password errata";
}

//? COME LAVORARE CON LE SESSIONI
//*APRI UNA SESSIONE OGNI VOLTA CHE UTILIZZI UN QUALCOSA INERENTE
session_start();
$_SESSION["nome"] = "Mario"; //* PER IMPOSTARE UNA VARIABILE IN SESSIONE <!-- $_SESSION["nome variabile"] = "valore" -->
var_dump($_SESSION["nome"]); //* per richiamare una variabile in sessione
//! cancellare varibili e sessioni
session_unset();
session_destroy();

//? COME USARE I COOKIE ES RESTA CONNESSO
//* se si flegga l'input per rimanere connesso
//! CREA E SALVA UN TOKEN NEL DATABASE DELL'UTENTE LOGGATO - CREA UN COOKIE CON IL TOKEN
$token = bin2hex(random_bytes(32));
                        //* nome colonna
$sql = "UPDATE utenti SET token_ricordami = :token WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([":token"=>$token, ":id=>$id <!-- preso in precedenza -->"]);
                                //*30 giorni di validità // "/" indica che è valido su tutte le pagine
setcookie("ricordami", $token, time()+60*60*24*30, "/");
//! CONTROLLA SU OGNI PAGINA: SE NON C'è LA SESSIONE MA C'è IL COOKIE, PRENDI IL TOKEN DEL COOKIE E CONFRONTALO CON QUELLO NEL DATABASE, SE CORRISPONDE IMPOSTA L'ID NELLA SESSIONE
if(!isset($_SESSION["id"]) && isset($_COOKIE["token"])){
    $sql = "SELECT * FROM utenti WHERE token_ricordami = :token";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":token"=>$_COOKIE["token"]]);
    $risultato = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["id"] = intval($risultato["id"]);
}
//! se non esiste una sessione vai al login
if(!isset($_SESSION["id"])){
    header("Location: <!-- percorso file login -->");
    exit();
}



}catch(PDOException $e){
//? IN CASO DI ERRORE
//* SALVA L'ERRORE IN UN FILE DEDICATO E MOSTRI ALL'UTENTE UN MESSAGGIO ECHO
error_log("Errore". $e->getMessage(), 3, "C:/xampp/php/logs/php_error_log");
echo "Errore, riprova più tardi";
}