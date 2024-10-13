<?php
include './connessione.php';

// prendi input
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$ruolo = !empty($_POST['ruolo']) ? $_POST['ruolo'] : null;
// id da modificar
$id = intval($_POST['id']);
var_dump($id);

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
if ($ruolo !== "operaio" && $ruolo !== "amministratore" && $ruolo !== "contabile" && $ruolo !== "dipendente") {
    $ruolo = null;
}


if ($id > 0) {
    if ($ruolo === null) {
        // creazione quary per modificare
        $sql = 'UPDATE dipendenti SET nome = ?, cognome = ?, email = ? WHERE id = ?';
        // controllo sicuro
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $cognome, $email, $id);
    } else {
        // creazione quary per modificare
        $sql = 'UPDATE dipendenti SET nome = ?, cognome = ?, email = ?, ruolo = ? WHERE id = ?';
        // controllo sicuro
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nome, $cognome, $email, $ruolo, $id);
    }
} else {
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
}



// esegui la quary 
if (!$stmt->execute()) {
    echo "Errore: " . $stmt->error;
}

$stmt->close();

header('Location: ../index.php');
exit();
