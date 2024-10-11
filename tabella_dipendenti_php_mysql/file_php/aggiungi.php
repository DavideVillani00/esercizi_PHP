<?php
include './connessione.php';

// prendi input
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$ruolo = !empty($_POST['ruolo']) ? $_POST['ruolo'] : null;


// controllo campi vuoti
if (is_numeric($nome) || $nome === "" || strlen($nome) < 3 || preg_match("/\d+/", $nome)) {
    die("inserisci un nome valido");
}
if (is_numeric($cognome) || $cognome === "" || strlen($cognome) < 3) {
    die("inserisci un cognome valido");
}
if (!preg_match("/^[\w\.\-]{2,}+@[a-z_]+\.[a-z]{2,}$/", $email) || $email === "") {
    die("inserisci un'email valida");
}


// quary diverse in base se il ruolo è vuoto
if ($ruolo === null) {
    // creazione quary
    $sql = 'INSERT INTO dipendenti (nome, cognome, email) VALUES (?, ?, ?)';
    // controllo quary
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $cognome, $email);
} else {
    // creazione quary
    $sql = 'INSERT INTO dipendenti (nome, cognome, email, ruolo) VALUES (?, ?, ?, ?)';
    // controllo quary
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $cognome, $email, $ruolo);
}



// esegui la quary 
if (!$stmt->execute()) {
    echo "Errore: " . $stmt->error;
} else {
    echo "nuovo dipendente aggiunto";
}

$stmt->close();

header('Location: ../index.php');
exit();
