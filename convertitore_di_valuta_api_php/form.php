<?php
/* i primi 2 non vanno */
$valore = $_GET["valore"];
$valuta1 = $_GET["valuta1"];
$valuta2 = $_GET["valuta2"];
$host = "api.frankfurter.app";
$url = "https://$host/latest?amount=$valore&from=$valuta1&to=$valuta2";

if($valuta1 === $valuta2){
    echo "Seleziona due valute differenti per poter fare la conversione.";
}else{
    if($valore == 0){
        echo "Inserisci un valore diverso da 0 per poter fare il cambio.";
    }else if(!is_numeric($valore)) {
        echo "Inserisci un numero.";
    }else{
        // api
// inizializzo sessione
    $ch = curl_init();
// imposto le opzioni della sessione
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// esegui sessione
    $response = curl_exec($ch);
// errori
    if(curl_errno($ch)){
        echo "Si è presentato il seguente errore: ". curl_error($ch);
    }else{
        $data = json_decode($response, true);
        
        $valore = $valore[0]== 0 && is_int($valore) ? ltrim($valore, 0) : $valore;
        echo $valore." ". $valuta1. " => ". $data["rates"][$valuta2]. " ". $valuta2;
    }
// chiudere la sessione
    curl_close($ch);
    }
}





?>