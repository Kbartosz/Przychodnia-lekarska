<?php
// include 'config.php';

// header('Content-Type: application/json');

// try {
//     $stmt = $conn->query("SELECT data_wizyty, lekarz FROM wizyta");
//     $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     $events = [];
//     foreach ($wizyty as $wizyta) {
//         $events[] = [
//             'date' => $wizyta['data_wizyty'],
//             'description' => "Wizyta u: " . $wizyta['lekarz']
//         ];
//     }

//     echo json_encode($events);
// } catch (PDOException $e) {
//     echo json_encode(['error' => "Błąd bazy danych: " . $e->getMessage()]);
// }




include 'config.php';

header('Content-Type: application/json');

try {
    // Pobranie wizyt z bazy danych wraz z danymi lekarza i pacjenta
    $stmt = $conn->query("
        SELECT w.id_wizyty, w.data_wizyty, w.godzina, 
               l.imie AS imie_lekarza, l.nazwisko AS nazwisko_lekarza, 
               p.imie AS imie_pacjenta, p.nazwisko AS nazwisko_pacjenta
        FROM wizyty w
        JOIN lekarz l ON w.id_lekarza = l.id_lekarza
        JOIN pacjent p ON w.id_pacjenta = p.id_pacjenta
    ");
    
    $wizyty = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $events = [];

    foreach ($wizyty as $wizyta) {
        // $events[] = [
        //     'id' => $wizyta['id_wizyty'],
        //     'date' => $wizyta['data_wizyty'],
        //     'time' => $wizyta['godzina'],
        //     'description' => "Wizyta u dr. " . $wizyta['imie_lekarza'] . " " . $wizyta['nazwisko_lekarza'] .
        //                      " | Pacjent: " . $wizyta['imie_pacjenta'] . " " . $wizyta['nazwisko_pacjenta']
        // ];

        $events[] = [
            'id' => $wizyta['id_wizyty'],
            'date' => $wizyta['data_wizyty'],
            'time' => $wizyta['godzina'],
            'description' => "Wizyta u dr. " . $wizyta['imie_lekarza'] . " " . $wizyta['nazwisko_lekarza'] . "<br>" .
                             "Pacjent: " . $wizyta['imie_pacjenta'] . " " . $wizyta['nazwisko_pacjenta'] . "<br>" .
                             "Godzina: " . $wizyta['godzina']
        ];
        

    }


    echo json_encode($events, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(['error' => "❌ Błąd bazy danych: " . $e->getMessage()]);
}


// ?>

