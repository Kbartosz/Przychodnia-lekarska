<?php
// session_start();
// include 'config.php';

// // Sprawdzenie, czy użytkownik jest zalogowany
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.html"); // Przekierowanie do logowania
//     exit();
// }

// $user_id = $_SESSION['user_id'];

// try {
//     $stmt = $conn->prepare("SELECT imie, nazwisko, wiek, pesel, mail FROM pacjent WHERE id_pacjenta = ?");
//     $stmt->execute([$user_id]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$user) {
//         die("Błąd: Nie znaleziono danych użytkownika.");
//     }
// } catch (PDOException $e) {
//     die("Błąd bazy danych: " . $e->getMessage());
// }
?>
<!-- 
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil pacjenta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Profil pacjenta</h1>

        
        <div class="profile-section">
            <div class="profile-picture">
                <img src="https://via.placeholder.com/200" alt="Zdjęcie profilu">
            </div>
            <div class="profile-details">
                <p><span>Imię i nazwisko:</span> <?php echo htmlspecialchars($user['imie'] . ' ' . $user['nazwisko']); ?></p>
                <p><span>Wiek:</span> <?php echo htmlspecialchars($user['wiek']); ?></p>
                <p><span>PESEL:</span> <?php echo htmlspecialchars($user['pesel']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($user['mail']); ?></p>
            </div>
        </div>

        
        <div class="buttons-container">
            <a href="#recepty" class="button">Recepty</a>
            <a href="cal.html" class="button">Wizyty</a>
            <a href="logout.php" class="button logout">Wyloguj</a>
        </div>
    </div>
</body>
</html> -->


<?php
include 'config.php'; // Include your database connection

// Check if PESEL is provided in the URL
if (!isset($_GET['pesel'])) {
    header("Location: pesel_input.php"); // Redirect to PESEL input page
    exit();
}

$pesel = $_GET['pesel'];

try {
    $stmt = $conn->prepare("SELECT imie, nazwisko, wiek, pesel, mail FROM pacjent WHERE pesel = :pesel");
    $stmt->bindParam(':pesel', $pesel);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Błąd: Nie znaleziono danych użytkownika.");
    }
} catch (PDOException $e) {
    die("Błąd bazy danych: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil pacjenta</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #00274d;
            text-align: center;
            font-size: 3rem;
            margin-bottom: 50px;
        }
        .profile-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 50px;
        }
        .profile-details {
            flex: 1;
            padding-right: 40px;
        }
        .profile-details p {
            margin: 15px 0;
            font-size: 1.8rem;
        }
        .profile-details p span {
            font-weight: bold;
            color: #00274d;
        }
        .profile-picture {
            flex: 0.5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-picture img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 5px solid #00274d;
        }
        .buttons-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            width: 100%;
        }
        .button {
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            text-decoration: none;
            font-size: 1.8rem;
            color: white;
            background-color: #00274d;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .button:hover {
            background-color: #004c99;
            transform: scale(1.05);
        }
        .button.logout {
            background-color: #d9534f;
        }
        .button.logout:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profil pacjenta</h1>

        <!-- Sekcja danych pacjenta -->
        <div class="profile-section">
            <div class="profile-picture">
                <img src="https://via.placeholder.com/200" alt="">
            </div>
            <div class="profile-details">
                <p><span>Imię i nazwisko:</span> <?php echo htmlspecialchars($user['imie'] . ' ' . $user['nazwisko']); ?></p>
                <p><span>Wiek:</span> <?php echo htmlspecialchars($user['wiek']); ?></p>
                <p><span>PESEL:</span> <?php echo htmlspecialchars($user['pesel']); ?></p>
                <p><span>Email:</span> <?php echo htmlspecialchars($user['mail']); ?></p>
            </div>
        </div>

        <!-- Przyciski -->
        <div class="buttons-container">
            <!-- <a href="#recepty" class="button">Recepty</a> -->
            <a href="cal.html" class="button">Wizyty</a>
            <a href="logout.php" class="button logout">Wyloguj</a>
        </div>
    </div>
</body>
</html>