<?php
$lunghezza = $_POST["lunghezza"];
$num = $_POST["numeri"] ?? null;
$let_min = $_POST["lettere_minuscole"] ?? null;
$let_mai = $_POST["lettere_maiuscole"] ?? null;
$car = $_POST["caratteri_speciali"] ?? null;
$incl = [];


if (!is_numeric($lunghezza)) {
    echo "Scrivi un numero.";
} elseif (!($num || $let_min || $let_mai || $car)) {
    echo "Seleziona almeno una categoria da includere.";
} else {
    if ($lunghezza < 8) {
        echo "Puoi fare di meglio, meglio inserire una lunghezza superiore a 7 caratteri per una password più sicura.";
    } else {
        $num ? array_push($incl, "0123456789") : "";
        $let_min ? array_push($incl, "qwertyuioplkjhgfdsazxcvbnm") : "";
        $let_mai ? array_push($incl, "QWERTYUIOPLKJHGFDSAZXCVBNM") : "";
        $num ? array_push($incl, "+-_:,;<>*/.[]{}^'?=()/&%!$") : "";
        echo genera_pass($incl, $lunghezza);
    }
}

function genera_pass($incl, $lunghezza)
{
    $password = "";
    $incl = implode("", $incl);
    for ($i = 0; $i < $lunghezza; $i++) {
        $password .= $incl[rand(0, strlen($incl) - 1)];
    }
    return $password;
}
