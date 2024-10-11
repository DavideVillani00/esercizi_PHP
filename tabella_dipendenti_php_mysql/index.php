<?php
include './file_php/connessione.php';
// controllo per vedere se si sta modificando un dipendente per poter precompilare l'input
if (isset($_GET["mod_id"])) {
  // crea variabile per id formattando in numero intero 
  $mod_id = intval($_GET["mod_id"]);
  // crea la query evitando le sql injection
  $sql = " SELECT * FROM dipendenti WHERE id = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $mod_id);
  // esegui la query protetta
  $stmt->execute();
  // salva il risultato
  $risultato = $stmt->get_result();

  //  controlla che il risultato abbia valori interni
  if ($risultato->num_rows > 0) {
    // ottieni i dati per ogni elemento
    $elem = $risultato->fetch_assoc();
    // imposta i dati nelle varaibili per precompilare l'input
    $nome = $elem["nome"];
    $cognome = $elem["cognome"];
    $email = $elem["email"];
    $ruolo = $elem["ruolo"];
  }
} else {
  // imposta i dati nelle varaibili per precompilare l'input
  $nome = "";
  $cognome = "";
  $email = "";
  $ruolo = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tabella dipendenti</title>
  <link rel="stylesheet" href="../tabella_dipendenti_php_mysql/style.css" />
</head>

<body>
  <!-- titolo -->
  <h1>Dipendenti:</h1>
  <button id="aggiungi">Aggiungi dipendente</button>
  <!-- form input dipendente -->
  <form action="./file_php/aggiungi_modifica.php" method="post">
    <!-- creazione di un input nascosto per poter passare l'id al file aggiungi_modifica.php -->
    <input type="hidden" name="id" value="<?php echo isset($mod_id) ? $mod_id : '' ?>">
    <div id="container_aggiungi">
      <div class="card">
        <!-- i steatment php servono per scegliere aggiungi o modifica -->
        <h2><?php echo isset($mod_id) ? "Modifica il dipendente" : "Aggiungi un nuovo dipendente" ?></h2>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($nome); ?>" />
        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome" id="cognome" value="<?php echo htmlspecialchars($cognome); ?>" />
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" />
        <label for="ruolo">Ruolo:</label>
        <input type="text" name="ruolo" id="ruolo" value="<?php echo htmlspecialchars($ruolo); ?>" />
        <input type="submit" class="input_sub" value="<?php echo isset($mod_id) ? 'Modifica' : 'Aggiungi'; ?>" />
      </div>
    </div>
    <!-- tabella -->

    <?php
    $sql = 'SELECT * FROM dipendenti';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Data assunzione</th>
                <th>Ruolo</th>
              </tr>
              </thead>
              <tbody>";
      while ($row = $result->fetch_assoc()) {
        echo  "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['nome']}</td>
                          <td>{$row['cognome']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['assunzione']}</td>
                          <td>{$row['ruolo']}</td>
                          <td><a href= './index.php?mod_id={$row["id"]}'>Modifica</a></td>
                          <td><a href= './file_php/elimina.php?id={$row["id"]}'>Elimina</a></td>
                          
                      </tr>";
      }

      echo '</tbody>
         </table>';
    }



    ?>
  </form>
  <script src="app.js"></script>
</body>

</html>
<?php
$conn->close();
?>