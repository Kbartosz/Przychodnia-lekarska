<?php




// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "przychodznia";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// $sql = "INSERT INTO pacjent (pesel, imie,nazwisko,wiek,haslo,mail,plec)
// VALUES (33333,'rrere','ttrtr',44,'34343434','ty@gh','K')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();







// include 'config.php';

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $imie = trim($_POST['name']);
//     $nazwisko = trim($_POST['Nazwi']);
//     $email = trim($_POST['email']);
//     $haslo = trim($_POST['password']);
//     $confirmHaslo = trim($_POST['confirm-password']);
//     $pesel = trim($_POST['pesel']);
//     $wiek = intval($_POST['Wiek']);
//     $gender=$_POST['gender'];

//     // Walidacja danych
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         die("Błędny format email.");
//     }
//     // if (!preg_match('/^\d{10}$/', $pesel)) {
//     //     die("PESEL musi składać się z 11 cyfr.");
//     // }
//     if ($haslo !== $confirmHaslo) {
//         die("Hasła nie pasują do siebie.");
//     }
//     if ($wiek <= 0 || $wiek > 150) {
//         die("Wiek jest nieprawidłowy.");
//     }
//     // Sprawdzenie, czy wybrano płeć
//     if (empty($gender)) {
//         die("Błąd: Musisz wybrać płeć!");
//     }

//     // Hashowanie hasła
//     $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);

//     try {
//         $stmt = $conn->prepare("INSERT INTO pacjent (pesel, imie, nazwisko, wiek, haslo, mail,plec) VALUES (?, ?, ?, ?, ?, ?,?)");
//         $stmt->execute([$pesel, $imie, $nazwisko, $wiek,  $hashedPassword,$email,$gender]);
        
//         echo "Rejestracja zakończona sukcesem!";
//         header("Location: index.html");
//     } catch (PDOException $e) {
//         if ($e->getCode() === '23000') {
//             die("Email lub PESEL już istnieje.");
//         }
//         die("Błąd bazy danych: " . $e->getMessage());
//     }
// }


// include 'config.php';

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $imie = trim($_POST['name']);
//     $nazwisko = trim($_POST['Nazwi']);
//     $email = trim($_POST['email']);
//     $haslo = trim($_POST['password']);
//     $confirmHaslo = trim($_POST['confirm-password']);
//     $pesel = trim($_POST['pesel']);
//     $wiek = intval($_POST['Wiek']);
//     $gender = $_POST['gender'];

//     // Walidacja danych
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         die("Błędny format email.");
//     }
//     if (!preg_match('/^\d{11}$/', $pesel)) {
//         die("PESEL musi składać się z 11 cyfr.");
//     }
//     if ($haslo !== $confirmHaslo) {
//         die("Hasła nie pasują do siebie.");
//     }
//     if (strlen($haslo) < 6) {
//         die("Hasło musi mieć co najmniej 6 znaków.");
//     }
//     if ($wiek <= 0 || $wiek > 150) {
//         die("Wiek jest nieprawidłowy.");
//     }
//     if (empty($gender)) {
//         die("Błąd: Musisz wybrać płeć!");
//     }

//     try {
//         // SPRAWDZENIE CZY PESEL JUŻ ISTNIEJE
//         $stmt = $conn->prepare("SELECT COUNT(*) FROM pacjent WHERE pesel = ?");
//         $stmt->execute([$pesel]);
//         $count = $stmt->fetchColumn();
        
//         if ($count > 0) {
//             die("Błąd: PESEL już istnieje w systemie!");
//         }

//         // Hashowanie hasła przed zapisaniem do bazy
//         $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);

//         // Wstawianie nowego użytkownika do bazy
//         $stmt = $conn->prepare("INSERT INTO pacjent (pesel, imie, nazwisko, wiek, haslo, mail, plec) VALUES (?, ?, ?, ?, ?, ?, ?)");
//         $stmt->execute([$pesel, $imie, $nazwisko, $wiek, $hashedPassword, $email, $gender]);
        
//         echo "Rejestracja zakończona sukcesem!";
//         header("Location: index.html");
//         exit();
//     } catch (PDOException $e) {
//         die("Błąd bazy danych: " . $e->getMessage());
//     }
// }






// include 'config.php';

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $imie = trim($_POST['name']);
//     $nazwisko = trim($_POST['Nazwi']);
//     $email = trim($_POST['email']);
//     $haslo = trim($_POST['password']);
//     $confirmHaslo = trim($_POST['confirm-password']);
//     $pesel = trim($_POST['pesel']);
//     $wiek = intval($_POST['Wiek']);
//     $gender = $_POST['gender'];

//     // Walidacja danych
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         die("Błędny format email.");
//     }
//     if (!preg_match('/^\d{11}$/', $pesel)) {
//         die("PESEL musi składać się z 11 cyfr.");
//     }
//     if ($haslo !== $confirmHaslo) {
//         die("Hasła nie pasują do siebie.");
//     }
//     if (strlen($haslo) < 6) {
//         die("Hasło musi mieć co najmniej 6 znaków.");
//     }
//     if ($wiek <= 0 || $wiek > 150) {
//         die("Wiek jest nieprawidłowy.");
//     }
//     if (empty($gender)) {
//         die("Błąd: Musisz wybrać płeć!");
//     }

//     // SPRAWDZENIE CZY PESEL JUŻ ISTNIEJE
//     $stmt = $conn->prepare("SELECT COUNT(*) FROM pacjent WHERE pesel = ?");
//     $stmt->bind_param("s", $pesel);
//     $stmt->execute();
//     $stmt->bind_result($count);
//     $stmt->fetch();
//     $stmt->close();

//     if ($count > 0) {
//         die("Błąd: PESEL już istnieje w systemie!");
//     }

//     // Hashowanie hasła przed zapisaniem do bazy
//     $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);

//     // Wstawianie nowego użytkownika do bazy
//     $stmt = $conn->prepare("INSERT INTO pacjent (pesel, imie, nazwisko, wiek, haslo, mail, plec) VALUES (?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("sssisss", $pesel, $imie, $nazwisko, $wiek, $hashedPassword, $email, $gender);

//     if ($stmt->execute()) {
//         echo "Rejestracja zakończona sukcesem!";
//         header("Location: index.html");
//         exit();
//     } else {
//         die("Błąd bazy danych: " . $conn->error);
//     }

//     $stmt->close();
// }




include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $imie = trim($_POST['name']);
    $nazwisko = trim($_POST['Nazwi']);
    $email = trim($_POST['email']);
    $haslo = trim($_POST['password']);
    $confirmHaslo = trim($_POST['confirm-password']);
    $pesel = trim($_POST['pesel']);
    $wiek = intval($_POST['Wiek']);
    $gender = $_POST['gender'];

    // Walidacja danych
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Błędny format email.");
    }
    if (!preg_match('/^\d{11}$/', $pesel)) {
        die("❌ PESEL musi składać się z 11 cyfr.");
    }
    if ($haslo !== $confirmHaslo) {
        die("❌ Hasła nie pasują do siebie.");
    }
    if (strlen($haslo) < 6) {
        die("❌ Hasło musi mieć co najmniej 6 znaków.");
    }
    if ($wiek <= 0 || $wiek > 150) {
        die("❌ Wiek jest nieprawidłowy.");
    }
    if (empty($gender)) {
        die("❌ Błąd: Musisz wybrać płeć!");
    }

    try {
        // SPRAWDZENIE CZY PESEL JUŻ ISTNIEJE
        $stmt = $conn->prepare("SELECT COUNT(*) FROM pacjent WHERE pesel = ?");
        $stmt->execute([$pesel]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            die("❌ Błąd: PESEL już istnieje w systemie!");
        }

        // Hashowanie hasła przed zapisaniem do bazy
        $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);

        // Wstawianie nowego użytkownika do bazy
        $stmt = $conn->prepare("INSERT INTO pacjent (pesel, imie, nazwisko, wiek, haslo, mail, plec) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$pesel, $imie, $nazwisko, $wiek, $hashedPassword, $email, $gender]);

        echo "✅ Rejestracja zakończona sukcesem!";
        header("Location: index.html");
        exit();
    } catch (PDOException $e) {
        die("❌ Błąd bazy danych: " . $e->getMessage());
    }
}



















?>
