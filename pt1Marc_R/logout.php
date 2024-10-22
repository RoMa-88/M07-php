<?php
// Fase 2: Destruïm la sessió actual i redirigim a la pàgina principal per tancar sessió de forma segura
session_start();
session_destroy(); // Elimina totes les dades de sessió
header("Location: index.php"); // Redirigeix a la pàgina d'inici
exit();
