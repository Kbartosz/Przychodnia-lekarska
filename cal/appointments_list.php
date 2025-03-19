<?php
include 'config.php';

// Pobierz wszystkie wizyty
try {
    $stmt = $conn->query("
        SELECT wizyty.id_wizyty, wizyty.data_wizyty, wizyty.godzina, 
               pacjent.imie, pacjent.nazwisko, lekarz.imie AS lekarz_imie, lekarz.nazwisko AS lekarz_nazwisko
        FROM wizyty
        JOIN pacjent ON wizyty.id_pacjenta = pacjent.id_pacjenta
        JOIN lekarz ON wizyty.id_lekarza = lekarz.id_lekarza
        ORDER BY wizyty.data_wizyty ASC, wizyty.godzina ASC
    ");

    $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Błąd bazy danych: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista wizyt</title>
    <link rel="stylesheet" href="styles.css">
    <style>
         body {

margin: 0;

padding: 0;

height: 100vh;


}

.button {

background-color: blue; /* Button color */

color: white; /* Text color */

border: none; /* No border */

padding: 10px 20px; /* Padding around the text */

text-align: center; /* Center text */

text-decoration: none; /* No underline */

display: inline-block; /* Allows setting width and height */

font-size: 16px; /* Font size */

cursor: pointer; /* Pointer cursor on hover */

border-radius: 5px; /* Rounded corners */
position: absolute;
      top: 5px;
      left: 5px;

}
    </style>
    <script>
        function cancelAppointment(id) {
            if (confirm("Czy na pewno chcesz odwołać tę wizytę?")) {
                fetch('cancel_appointment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id_wizyty=' + id
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); // Odśwież stronę po usunięciu wizyty
                })
                .catch(error => console.error('Błąd:', error));
            }
        }
    </script>
</head>
<body>
<a href="cal.html" class="button">kalendarz</a>
    <!-- <h2>Lista wizyt</h2> -->
    <table border="1">
        <tr>
            <th>Data</th>
            <th>Godzina</th>
            <th>Pacjent</th>
            <th>Lekarz</th>
            <th>Akcja</th>
        </tr>
        <?php foreach ($wizyty as $wizyta): ?>
            <tr>
                <td><?= htmlspecialchars($wizyta['data_wizyty']) ?></td>
                <td><?= htmlspecialchars($wizyta['godzina']) ?></td>
                <td><?= htmlspecialchars($wizyta['imie'] . " " . $wizyta['nazwisko']) ?></td>
                <td><?= htmlspecialchars($wizyta['lekarz_imie'] . " " . $wizyta['lekarz_nazwisko']) ?></td>
                <td>
                    <button onclick="cancelAppointment(<?= $wizyta['id_wizyty'] ?>)">❌ Odwołaj</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
