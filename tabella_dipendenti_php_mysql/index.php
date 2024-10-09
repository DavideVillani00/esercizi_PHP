<?php
include './file_php/connessione.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tabella dipendenti</title>
  <link rel="stylesheet" href="./style.css" />
</head>

<body>
  <h1>Dipendenti:</h1>
  <form action="./file_php/aggiungi.php" method="post">
    <button id="aggiungi">Aggiungi dipendente</button>
    <div id="container_aggiungi">
      <div class="card">
        <h2>Aggiungi un nuovo dipendente</h2>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" />
        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome" id="cognome" />
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" />
        <label for="ruolo">Ruolo:</label>
        <input type="text" name="ruolo" id="ruolo" />
        <input type="submit" value="Aggiungi" class="input_sub" />
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Cognome</th>
          <th>Email</th>
          <th>Data assunzione</th>
          <th>Ruolo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
        </tr>
      </tbody>
    </table>
  </form>
  <!-- <script src="app.js"></script> -->
</body>

</html>
<?php
$conn->close();
?>