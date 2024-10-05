<?php
$nome = $_POST["nome"];
$email = $_POST["email"];
$commento = $_POST["commento"];
$nome_valido = false;
$email_valido = false;
$commento_valido = false;

// controllo del nome
switch ($nome) {
    case "":
        echo "Ti sei dimenticato di scrivere il tuo nome. <br>";
        break;
    case is_numeric($nome):
        echo "Da quando esistono nomi con numeri? <br>";
        break;
    case strlen($nome) < 3:
        echo "Inserisci un nome valido. <br>";
        break;

    default:
        if (preg_match("/\d+/", $nome)) {
            echo "I nomi non hanno numeri! <br>";
        } else {
            $nome_valido = true;
        }

        break;
}

// controllo della mail
if (!preg_match("/^[\w\.\-]+@[A-Za-z_]+\.[a-zA-Z]{2,}$/", $email)) {
    echo "Scrivi una mail valida. <br>";
} else {
    $email_valido = true;
}


// controllo del commento
switch ($commento) {
    case "":
        echo "Ti sei dimenticato di mettere il commento. <br>";
        break;
    case is_numeric($commento):
        echo "I numeri non sono considerati un commento valido. <br>";
        break;
    case strlen($commento) < 10:
        echo "Non meritiamo neanche un commento di almeno 10 caratteri? <br>";
        break;
    default:
        $commento_valido = true;
        break;
}

if ($nome_valido === true && $email_valido === true && $commento_valido === true) {
    $nome[0] = strtoupper($nome[0]);
    echo $nome . ", grazie per il tuo commento. <br>";
}
