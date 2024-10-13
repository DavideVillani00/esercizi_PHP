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
        <h1>Registrati</h1>
        <form action="./file_php/controllo.php" method="post">
            <input type="text" name="nome" id="nome" placeholder="Nome">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="ripeti_password" id="ripeti_password" placeholder="Ripeti password">
            <input type="submit" value="Registrati">
        </form>
        <a href="#">Sei già registrato?</a>
    </div>
</body>

</html>