<?php
// Fase 1: Verifiquem si la sessió ja està iniciada abans de començar una nova sessió
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>DAWBI-M07-Pt11</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <?php include_once "topmenu.php"; ?>
        <div class="container">
            <h2>Buy tickets.com</h2>
            <section class="welcome-section">
                <h1>Benvingut a la Botiga d'Entrades</h1>
                <p>Compra entrades per als esdeveniments més emocionants. Explora les nostres categories i selecciona els esdeveniments que més t'agradin.</p>
                <img src="images/events.jpg" alt="Imatge de benvinguda">
            </section>
        </div>
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>