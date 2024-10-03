<?php
$nome = $_POST["nome"];
$email = $_POST["email"];
$commento = $_POST["commento"];
// var_dump($nome);
// var_dump($email);
// var_dump($commento);

switch ($nome) {
    case "":
       echo "scrivi il tuo nome";
        break;
        /* da inserire in caso di stringhe con numeri e lettere */
    case is_numeric($nome):
        echo "non esistono nomi con numeri";
        break;
    case strlen($nome)<3 :
       echo "inserisci un nome valido";
        break;
    
    default:
    var_dump($nome);
        break;
}

// if($nome == ""){
// echo "scrivi il tuo nome";
// }




// if(strlen($nome)<3){
//     echo "inserisci un nome valido";
// // }elseif(inserire la regole regex per la email){

// }else{
//     echo "scrivi qualcosa di più lungo";
// }


?>