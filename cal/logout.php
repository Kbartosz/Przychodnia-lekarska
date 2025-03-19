<?php
session_start();
session_unset();  // Usunięcie wszystkich zmiennych sesji
session_destroy(); // Zniszczenie sesji

header("Location: index.html"); // Przekierowanie na stronę główną (lub logowania)
exit();
?>
