<?php
include "./connessione.php";

// variabili input
$registrato = $_POST['registrato'];
$nome = isset($_POST['nome'])?$_POST['nome']: null;
$email = $_POST['email'];
$password = $_POST['password'];
$ripeti_password = isset($_POST['ripeti_password'])?$_POST['ripeti_password']: null;


// controllo input in modo basilare
if($registrato === 'false'){
    if ((strlen($nome) < 3 || is_numeric($nome) || $nome === "" || preg_match("/\d+/", $nome))) {
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

// query per aggiungere utenti
$sql = 'INSERT INTO utenti_registrati (nome, email, password) VALUES (?, ?, ?)';

// evita sql injiected
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $password);

$stmt->execute();
$stmt->close();

// !! ATTENZIONE questa è una prova, ci sarà da usare la password hashata e controllare che le azioni sotto vadano solo quando si ha un account
}else{
    // prendi il profilo
    $sql = 'SELECT password FROM utenti_registrati WHERE email = ?';
    // evita injiection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    // esegui
    $stmt->execute();
    // prendi il risultato
    $result = $stmt->get_result();
    // se si ha almeno 1 risultato
    if($result->num_rows>0){
        // prendi ogni riga e controlla la password
        $row = $result->fetch_assoc();
        if($row['password'] === $password){
            echo "benvenuto";
        }else{
            echo "password sbagliata";
        }
    }else{
        echo "la mail non corrisponde a nessun utente";
    }
    
   $stmt->close();

}


















$conn->close();
