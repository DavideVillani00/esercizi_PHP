<?php
require("./file_php/connessione.php");
// conta quanti ristoranti ci sono
$sql = "SELECT COUNT(id_ristorante) FROM ristoranti_recensioni_php_mysql";
$stmt = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ristoranti</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- header -->
    <header>
        <h3>ciao "nome"</h3>
        <h1>Ristoranti</h1>
        <a href="#">Accedi/registrati</a>
    </header>
    <main>
        <!-- nome con img -->
        <h3>"nome Risorante"</h3>
        <div id="immagini">
            <a href="./index.php?id=<?php echo $id_precedente; ?>"><img src="./icone/icons8-cerchiato-sinistra-96.png" alt="freccia sinistra"></a>
            <img src="https://www.erboristeriabio.com/images/prod_erbor_integratori/prova.jpg" alt="foto del ristorante">
            <a href="./index.php?id=<?php echo $id_successivo; ?>"><img src="./icone/icons8-cerchiato-destro-96.png" alt="freccia destra"></a>
        </div>
        <!-- sezione descrizione con recensioni -->
        <div id="descrizione">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa illo, vitae fugit, est, similique ea nostrum in dolore magni eveniet vel eum ratione rem numquam cum voluptas iure eaque repellat.</p>
            <div id="stelle">
                <div class="stella"><img src="./icone/grey-icons8-stella-ios-17-glyph-32.png" alt="stella"></div>
                <div class="stella"><img src="./icone/grey-icons8-stella-ios-17-glyph-32.png" alt="stella"></div>
                <div class="stella"><img src="./icone/grey-icons8-stella-ios-17-glyph-32.png" alt="stella"></div>
                <div class="stella"><img src="./icone/grey-icons8-stella-ios-17-glyph-32.png" alt="stella"></div>
                <div class="stella"><img src="./icone/grey-icons8-stella-ios-17-glyph-32.png" alt="stella"></div>
                <p>(0)</p>
            </div>
            <a href="#">Vedi recensioni</a>
        </div>
    </main>

</body>

</html>