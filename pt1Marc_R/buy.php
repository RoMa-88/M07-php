<?php
session_start();

// Verificar si el usuario está validado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Recoger los datos del evento pasados por la URL
$event_name = isset($_GET['name']) ? $_GET['name'] : '';
$event_price = isset($_GET['price']) ? floatval($_GET['price']) : 0;  // Convertir el precio a float para evitar errores
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';

$errors = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        // Redirigir a la página principal si se cancela
        header("Location: index.php");
        exit();
    } elseif (isset($_POST['purchase'])) {
        $num_tickets = $_POST['num_tickets'];

        // Validación del número de entradas
        if (empty($num_tickets)) {
            $errors = "Si us plau, introdueix el nombre d'entrades.";
        } elseif (!is_numeric($num_tickets)) {
            $errors = "El nombre d'entrades ha de ser un valor numèric.";
        } else {
            // Calcular el precio total
            $total_price = $num_tickets * $event_price; // Calcular el total correctamente
            $fullname = $_SESSION['fullname'];

            // Mostrar el resultado de la compra
            echo "<div class='alert alert-success' style='border: 1px solid; padding: 10px;'>
                    <p>$fullname has comprat $num_tickets entrades per $event_name.</p>
                    <p>Preu unitat: $event_price €</p>
                    <p>Quantitat: $num_tickets</p>
                    <p>Total: $total_price €</p>
                    <p>Gaudeix del espectacle!</p>
                  </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Compra d'entrades</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Compra d'entrades per a: <?php echo $event_name; ?></h2>
        <p>Preu: <?php echo $event_price; ?>€</p>

        <!-- Formulari de compra -->
        <form method="post" action="">
            <div class="form-group">
                <label for="num_tickets">Número d'entrades:</label>
                <!-- Selector desplegable para número de entradas -->
                <select name="num_tickets" id="num_tickets" class="form-control">
                    <?php
                    // Generar opciones para el número de entradas de 1 a 10
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Mostramos los errores si los hay -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger"><?php echo $errors; ?></div>
            <?php endif; ?>

            <!-- Botones de compra y cancelación -->
            <button type="submit" name="purchase" class="btn btn-primary">Comprar</button>
            <button type="submit" name="cancel" class="btn btn-default">Cancel·lar</button>
        </form>
    </div>
</body>

</html>