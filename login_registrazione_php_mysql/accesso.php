<?php

$registrato = isset($_GET['reg']) && $_GET['reg'] === 'true';

if (isset($_SESSION['loggato']) && $_SESSION['loggato'] === true) {
    header('Location: ./index.php');
    exit;
}

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schermata di accesso</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="card">
        <h1><?php echo !$registrato ? 'Registrati' : 'Accedi' ?></h1>
        <form action="./file_php/controllo.php" method="post">
            <input type="hidden" name="registrato" value="<?php echo boolval($registrato); ?>">
            <?php
            if (!$registrato) {
                echo  '<input type="text" name="nome" id="nome" placeholder="Nome">';
            }
            ?>
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Password">
            <?php
            if (!$registrato) {
                echo  '<input type="password" name="ripeti_password" id="ripeti_password" placeholder="Ripeti password">';
            } else {
                echo '<div id=ricordami_container>
                         <input type="checkbox" name="ricordami" id="ricordami">
                         <label for="ricordami">ricordami</label>
                     </div>';
            }
            ?>

            <input type="submit" value="<?php echo !$registrato ? 'Registrati' : 'Accedi' ?>">
        </form>
        <?php
        if (!$registrato) {
            echo  '<a href="./accesso.php?reg=true">Sei già registrato?</a>';
        } else {
            echo  '<a href="./accesso.php?reg=false">non sei registrato?</a>';
        }
        ?>


    </div>
</body>

</html>