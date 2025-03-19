<?php
include 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pesel = trim($_POST['pesel']);

    // Validate PESEL (11 digits)
    if (preg_match('/^\d{11}$/', $pesel)) {
        // Query the database for user information
        $stmt = $conn->prepare("SELECT imie, nazwisko, wiek, pesel, mail FROM pacjent WHERE pesel = :pesel");
        $stmt->bindParam(':pesel', $pesel);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Redirect to the profile page with user data
            header("Location: profil.php?pesel=" . $pesel);
            exit();
        } else {
            $error = "❌ Nie znaleziono użytkownika z tym PESEL.";
        }
    } else {
        $error = "❌ PESEL musi składać się z 11 cyfr.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wprowadź PESEL</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Wprowadź PESEL</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" action="">
            <label for="pesel">PESEL:</label>
            <input type="text" id="pesel" name="pesel" required>
            <button type="submit">Zatwierdź</button>
        </form>
    </div>
</body>
</html>