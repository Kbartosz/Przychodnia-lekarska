
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data_wizyty = trim($_POST['date']);
    $godzina = trim($_POST['hour']);
    $lekarz = trim($_POST['lek']);
    $pesel = trim($_POST['pesel']);

    // Sprawdzenie, czy pacjent o danym PESEL istnieje
    $stmt = $conn->prepare("SELECT id_pacjenta FROM pacjent WHERE pesel = ?");
    $stmt->execute([$pesel]);
    $pacjent = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pacjent) {
        die("❌ Pacjent o podanym PESEL nie istnieje.");
    }

    $pacjent_id = $pacjent['id_pacjenta'];

    // Dodanie wizyty do bazy
    try {
        $stmt = $conn->prepare("INSERT INTO wizyty (data_wizyty, godzina, id_lekarza, id_pacjenta) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data_wizyty, $godzina, $lekarz, $pacjent_id]);
        echo "✅ Wizyta została pomyślnie dodana!";
        header("Location: index.html");
    } catch (PDOException $e) {
        die("❌ Błąd bazy danych: " . $e->getMessage());
    }
}
?>
