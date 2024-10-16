<?php
include "./file_php/connessione.php";
if (!(isset($_SESSION['loggato']) && $_SESSION['loggato'] === true)) {
    header('Location: ./accesso.php');
    exit;
}
// recupero il nome dell'utente
$sql = 'SELECT nome FROM utenti_registrati WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($nome);
$stmt->fetch();
$stmt->close();


// cancello sessione e eimina cookie

if (isset($_POST['esci'])) {
    $_SESSION = array();
    session_destroy();
    setcookie('ricordami', '', time() - 42000, "/");
    header('Location: ./accesso.php?reg=true');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito web</title>
</head>

<body>
    <h1>ciao <?php echo $nome; ?>, che piacere vederti</h1>
    <form method="post" action=""><input type="submit" value="Esci" name="esci"></form>

</body>

</html>