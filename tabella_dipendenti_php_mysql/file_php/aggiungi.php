<?php
include './connessione.php';

// prendi input
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$ruolo = !empty($_POST['ruolo']) ? $_POST['ruolo'] : null;


// quary diverse in base se il ruolo è vuoto
if (!$ruolo === null) {
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
