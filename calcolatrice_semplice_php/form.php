<?php
$numero1 = $_GET["numero1"];
$numero2 = $_GET["numero2"];
$operatore = $_GET["operatori"];


if($numero1 !== "" && $numero2 !== "" && is_numeric($numero1) && is_numeric($numero2)){
switch ($operatore) {
    case "molt":
        echo $numero1 . " * " . $numero2 . " = " . $numero1*$numero2; 
        break;
    case "add":
        echo $numero1. " + ". $numero2. " = ". $numero1+$numero2;
        break;
    case "sott":
        echo $numero1. " - ". $numero2. " = ". $numero1-$numero2;
        break;
    case "div":
        if($numero2!=0){
            echo $numero1. " / ". $numero2. " = ". $numero1/$numero2;
        }else{
            echo "non è possibile dividere per 0";
        }
        break; 
    case "potY":
            echo $numero1. " ^ ". $numero2. " = ". pow($numero1, $numero2);
        break;
    case "radY":
            echo $numero2. " √ ". $numero1. " = ". pow($numero1, 1/$numero2);
        break;
    case "perc":
            echo $numero2. " % ". $numero1. " = ". ($numero1 * $numero2)/100;
        break;

    default:
        echo "scrivi solo il primo numero";
        break;
    }
}elseif($numero1 !== "" && $numero2 == "" && is_numeric($numero1)){
    switch ($operatore) {
        case "pot2":
           echo $numero1. " ^ 2 = ". pow($numero1, 2);
            break;
        case "pot3":
           echo $numero1. " ^ 3 = ". pow($numero1, 3);
            break;
        case "rad2":
           echo  "2 √ ". $numero1. " = ". pow($numero1, 1/2);
            break;
        case "rad3":
           echo  "3 √ ". $numero1. " = ". pow($numero1, 1/3);
            break;
        case "perc":
            echo $numero1. " % = ". $numero1/100;
            break;
        default:
        echo "scrivi entrambi i numeri";
        break;
    }
}else{
    echo "scrivi dei numeri validi";
}


?>