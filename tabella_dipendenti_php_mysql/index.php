<?php
include './file_php/connessione.php';
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
  <form action="./file_php/aggiungi.php" method="post">
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
    <!-- tabella -->

    <?php
    $sql = 'SELECT * FROM dipendenti';
    $result = $conn->query($sql);
if($result->num_rows>0){
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
              while($row = $result->fetch_assoc()){
                echo  "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['nome']}</td>
                          <td>{$row['cognome']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['assunzione']}</td>
                          <td>{$row['ruolo']}</td>
                          <td><a href= './file_php/modifica.php?id={$row["id"]}'>Modifica</a></td>
                          <td><a href= './file_php/elimina.php?id={$row["id"]}'>Elimina</a></td>
                          
                      </tr>";
              }
              
     echo '</tbody>
         </table>';
}
   
    
    
    ?>

    <!-- <table>
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
      </tbody>
    </table> -->
  </form>
  <script src="app.js"></script>
</body>

</html>
<?php
$conn->close();
?>