<?php
// Verifiquem si la sessió ja està iniciada abans de començar una nova sessió
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-default">
    <div class="container col-md-10">
        <div class="navbar-header">
            <a class="navbar-brand" href="https://www.proven.cat">ProvenSoft</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href='index.php'>Home</a></li>
            <li><a href='events.php'>Events</a></li>

            <?php
            // Fase 2: Mostrar el menú segons el rol de l'usuari
            if (isset($_SESSION['role'])) {
                // Opcions per a l'administrador
                if ($_SESSION['role'] == 'admin') {
                    echo "<li><a href='upload.php'>Pujar Imatges</a></li>";
                }
                // Opció de tancar sessió per a usuaris validades
                echo "<li><a href='logout.php'>Logout</a></li>";
            } else {
                // Opcions per als visitants no autenticats
                echo "<li><a href='register.php'>Register</a></li>";
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>