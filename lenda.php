<?php

// Parametrat e lidhjes me bazën e të dhënave
$host = 'localhost';
$dbname = 'smis';
$username = 'root';
$password = '';

// Lidhja me bazën e të dhënave duke përdorur PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Kontrolli nëse forma është dorëzuar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $language_name = $_POST['language_name'];

    // Shtimi i lëndës në bazën e të dhënave
    try {
        $query = "INSERT INTO language (language_name) VALUES (:languagename)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':languagename', $language_name);
        $stmt->execute();
        echo "Lënda u regjistrua me sukses!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi i Lëndës</title>
</head>

<body>
    <div class="container">
        <h2>Regjistrimi i Lëndës</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="language_name">Emri i Lëndës:</label><br>
            <input type="text" id="language_name" name="language_name"><br><br>
            <input type="submit" value="Regjistro Lëndën">
        </form>

        <h2>Lëndët e Regjistruara:</h2>
        <ul>
            <?php
            // Merr të gjitha lëndët nga tabela lenda
            $query = "SELECT * FROM language";
            $stmt = $pdo->query($query);
            $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Shfaq të gjitha lëndët në një listë
            foreach ($languages as $language) {
                echo "<li>" . $language['language_name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>
