<?php
// include 'config.php';

// if (!isset($_GET['pesel'])) {
//     echo json_encode([]);
//     exit;
// }

// $pesel = trim($_GET['pesel']);

// $stmt = $conn->prepare("SELECT w.id_wizyty, w.data_wizyty, w.godzina, l.nazwisko AS lekarz 
//                         FROM wizyty w 
//                         JOIN pacjent p ON w.id_pacjenta = p.id_pacjenta
//                         JOIN lekarze l ON w.id_lekarza = l.id_lekarza
//                         WHERE p.pesel = ?");
// $stmt->execute([$pesel]);
// $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($wizyty);

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// header('Content-Type: application/json');

// include 'config.php';

// header('Content-Type: application/json'); // Upewnij się, że PHP zwraca JSON

// if (!isset($_GET['pesel'])) {
//     echo json_encode(["error" => "❌ Brak numeru PESEL!"]);
//     exit;
// }

// $pesel = trim($_GET['pesel']);

// try {
//     $stmt = $conn->prepare("SELECT w.id_wizyty, w.data_wizyty, w.godzina, l.nazwisko AS lekarz 
//                             FROM wizyty w 
//                             JOIN pacjent p ON w.id_pacjenta = p.id_pacjenta
//                             JOIN lekarze l ON w.id_lekarza = l.id_lekarza
//                             WHERE p.pesel = ?");
//     $stmt->execute([$pesel]);
//     $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     if (!$wizyty) {
//         echo json_encode(["message" => "❌ Brak wizyt dla tego PESEL."]);
//         exit;
//     }

//     echo json_encode($wizyty);
// } catch (PDOException $e) {
//     echo json_encode(["error" => "❌ Błąd bazy danych: " . $e->getMessage()]);
// }



include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if (!isset($_GET['pesel']) || empty($_GET['pesel'])) {
    echo json_encode(["error" => "❌ Brak numeru PESEL!"]);
    exit;
}

$pesel = trim($_GET['pesel']);

try {
    $stmt = $conn->prepare("
        SELECT w.id_wizyty, w.data_wizyty, w.godzina, l.nazwisko AS lekarz 
        FROM wizyty w
        JOIN pacjent p ON w.id_pacjenta = p.id_pacjenta
        JOIN lekarze l ON w.id_lekarza = l.id_lekarza
        WHERE p.pesel = ?
    ");

    $stmt->execute([$pesel]);
    $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$wizyty) {
        echo json_encode(["message" => "❌ Brak wizyt dla tego PESEL."]);
        exit;
    }

    echo json_encode($wizyty);
} catch (PDOException $e) {
    echo json_encode(["error" => "❌ Błąd bazy danych: " . $e->getMessage()]);
}


?>
