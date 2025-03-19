<?php
// include 'config.php';

// if (!isset($_GET['id_wizyty'])) {
//     echo json_encode(["message" => "❌ Brak ID wizyty!"]);
//     exit;
// }

// $id_wizyty = intval($_GET['id_wizyty']);

// try {
//     $stmt = $conn->prepare("DELETE FROM wizyty WHERE id_wizyty = ?");
//     $stmt->execute([$id_wizyty]);
//     echo json_encode(["message" => "✅ Wizyta została odwołana!"]);
// } catch (PDOException $e) {
//     echo json_encode(["message" => "❌ Błąd bazy danych: " . $e->getMessage()]);
// }

include 'config.php';

// if (!isset($_GET['id_wizyty'])) {
//     echo json_encode(["message" => "❌ Brak ID wizyty!"]);
//     exit;
// }

// $id_wizyty = intval($_GET['id_wizyty']);

// try {
//     $stmt = $conn->prepare("DELETE FROM wizyty WHERE id_wizyty = ?");
//     $stmt->execute([$id_wizyty]);

//     if ($stmt->rowCount() > 0) {
//         echo json_encode(["message" => "✅ Wizyta została odwołana!"]);
//     } else {
//         echo json_encode(["message" => "❌ Wizyta nie istnieje lub została już odwołana!"]);
//     }
// } catch (PDOException $e) {
//     echo json_encode(["message" => "❌ Błąd bazy danych: " . $e->getMessage()]);
// }


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_wizyty'])) {
    $id_wizyty = intval($_POST['id_wizyty']);

    try {
        $stmt = $conn->prepare("DELETE FROM wizyty WHERE id_wizyty = ?");
        $stmt->execute([$id_wizyty]);

        if ($stmt->rowCount() > 0) {
            echo "✅ Wizyta została odwołana.";
        } else {
            echo "❌ Nie znaleziono wizyty.";
        }
    } catch (PDOException $e) {
        echo "❌ Błąd bazy danych: " . $e->getMessage();
    }
} else {
    echo "❌ Błąd: Niepoprawne żądanie.";
}


?>
