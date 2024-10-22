<?php
// Fase 2: Procés de registre d'un nou usuari
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registersubmit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];

  // Verificació: Assegurem que tots els camps estan plens
  if (empty($username) || empty($password) || empty($name) || empty($surname)) {
    echo "Per favor, omple tots els camps.";
  } else {
    // Obrim el fitxer users.txt per afegir el nou usuari
    $file = fopen("files/users.txt", "a+");
    $userExists = false;

    // Comprovem si el nom d'usuari ja existeix
    while (($line = fgets($file)) !== false) {
      list($storedUser) = explode(';', trim($line));
      if ($storedUser == $username) {
        $userExists = true;
        break;
      }
    }

    // Si el nom d'usuari no existeix, es registra el nou usuari
    if (!$userExists) {
      $newUser = "$username;$password;registered;$name;$surname\n";
      fwrite($file, $newUser); // Guardem el nou usuari al fitxer
      echo "Registre complet! Ara pots iniciar sessió.";
    } else {
      echo "Aquest usuari ja existeix.";
    }
    fclose($file); // Tanquem el fitxer després de l'ús
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Registre</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <h2>Formulari de registre</h2>
    <!-- Formulari per recollir les dades del nou usuari -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="username">Nom d'usuari:</label>
        <input type="text" class="form-control" id="username" placeholder="Nom d'usuari" name="username">
      </div>
      <div class="form-group">
        <label for="password">Contrasenya:</label>
        <input type="password" class="form-control" id="password" placeholder="Contrasenya" name="password">
      </div>
      <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" class="form-control" id="name" placeholder="Nom" name="name">
      </div>
      <div class="form-group">
        <label for="surname">Cognom:</label>
        <input type="text" class="form-control" id="surname" placeholder="Cognom" name="surname">
      </div>
      <button type="submit" name="registersubmit" class="btn btn-default">Enviar</button>
    </form>
  </div>
</body>

</html>