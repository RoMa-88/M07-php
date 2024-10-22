<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginsubmit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, rellena todos los campos.";
    } else {
        // Cargar los usuarios desde users.txt
        $file = fopen("files/users.txt", "r");
        $authenticated = false;

        while (($line = fgets($file)) !== false) {
            list($storedUser, $storedPass, $storedRole, $name, $surname) = explode(';', trim($line));

            // Autenticar si las credenciales coinciden
            if ($storedUser == $username && $storedPass == $password) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $storedRole;
                $_SESSION['fullname'] = "$name $surname";
                $authenticated = true;
                break;
            }
        }
        fclose($file);

        if ($authenticated) {
            echo "¡Bienvenido, " . $_SESSION['fullname'] . "!";
            header("Location: index.php");
        } else {
            echo "Credenciales inválidas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <h2>Login form</h2>


  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
   
    <button type="submit" name="loginsubmit" class="btn btn-default">Submit</button>
  </form>
</div>
</body>
</html>