<?php
include './connessione.php';
// non funziona
$id = intval($_GET['id']);
$sql =' DELETE   FROM dipendenti WHERE id= $id';
if($conn->query($sql)===TRUE){
    echo "dipendente eliminato";
}else{
    echo "errore";
}
header('Location: ../index.php');
exit();