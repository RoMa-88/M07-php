<?php
// Fase 1: Verifiquem si la sessió ja està iniciada abans de començar una nova sessió
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>DAWBI-M07-Pt11 - Events</title>
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
            <h2>Events</h2>

            <!-- Fase 1: Selector de categoria -->
            <form method="get" action="events.php">
                <div class="form-group">
                    <label for="category">Selecciona una categoria:</label>
                    <select id="category" name="category" class="form-control">
                        <?php
                        // Llegim les categories del fitxer
                        if (file_exists('files/categories.txt')) {
                            $categories = file('files/categories.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                            foreach ($categories as $category) {
                                list($id, $description) = explode(';', $category);
                                echo "<option value='$id'>$description</option>";
                            }
                        } else {
                            echo "<option value=''>No hi ha categories disponibles</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Veure esdeveniments</button>
            </form>

            <!-- Fase 1: Mostrar taula d'esdeveniments -->
            <?php
            if (isset($_GET['category'])) {
                $selected_category = $_GET['category'];

                // Verifiquem si hi ha esdeveniments
                if (file_exists('files/events.txt')) {
                    $events = file('files/events.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $found_events = false;

                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>ID</th><th>Nom</th><th>Preu (€)</th><th>Comprar</th></tr></thead>";
                    echo "<tbody>";

                    // Mostrem els esdeveniments de la categoria seleccionada
                    foreach ($events as $event) {
                        list($event_id, $category_id, $name, $price) = explode(';', $event);

                        if ($category_id === $selected_category) {
                            $found_events = true;
                            // Afegim l'enllaç per comprar entrades
                            echo "<tr>
                                    <td>$event_id</td>
                                    <td>$name</td>
                                    <td>$price</td>
                                    <td><a href='buy.php?event_id=$event_id&name=$name&price=$price' class='btn btn-primary'>Comprar</a></td>
                                  </tr>";
                        }
                    }

                    if (!$found_events) {
                        echo "<tr><td colspan='4'>No hi ha esdeveniments disponibles per aquesta categoria.</td></tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<p>No es poden carregar els esdeveniments. L'arxiu no existeix.</p>";
                }
            }
            ?>
        </div>
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>