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

// Merrni të gjithë studentët nga tabela "Student"
try {
    $query = "SELECT * FROM advancestudentet";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $advancestudentets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Merrni të gjitha lëndët nga tabela "Lenda"
try {
    $query = "SELECT * FROM language";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Kontrolli nëse forma është dorëzuar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $advancestudentet_id = $_POST['advancestudentet'];
    $language_id = $_POST['languages'];
    $grade = $_POST['nota']; // Corrected variable name

    // Shtimi i notës në bazën e të dhënave
    try {
        $query = "INSERT INTO studentgrades (advancestudentet_id, language_id, grade) VALUES (:advancestudentet_id, :language_id, :grade)"; // Corrected table name
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':advancestudentet_id', $advancestudentet_id);
        $stmt->bindParam(':language_id', $language_id);
        $stmt->bindParam(':grade', $grade);
        $stmt->execute();
        echo "Nota u regjistrua me sukses!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$futbollisti = array ("Ronaldo","Pele", "Mesi","Zidan");
for ($x=0; $x < count($futbollisti); $x++ ) {
if ($futbollisti [$x] != "Ronaldo" || $futbollisti [$x] !="Zidan") continue;
echo ($futbollisti[$x].$x.",");
}
?>

<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi i Notës</title>
</head>
<style>
    .containeri {
        
    }

    form {
        margin: 50px auto;
        width: 300px;
        height: 400px;
    }

    .style {
        margin: 20px 50px;
    }
</style>

<body>
    <div class="container">


        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2>Regjistrimi i Notës</h2>
            <div class="style">
                <label for="advancestudentet">Studenti:</label><br>
                <select id="advancestudentet" name="advancestudentet">
                    <?php foreach ($advancestudentets as $advancestudentet) : ?>
                        <option value="<?php echo $advancestudentet['id']; ?>"><?php echo ucfirst($advancestudentet['emri']) . ' ' . ucfirst($advancestudentet['mbiemri']); ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="languages">Lënda:</label><br>
                <select id="languages" name="languages">
                    <?php foreach ($languages as $language) : ?>
                        <option value="<?php echo $language['id']; ?>"><?php echo $language['language_name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
                <label for="nota">Nota:</label><br>
                <input type="number" id="nota" name="nota" min="5" max="10"><br><br>
                <input type="submit" value="Regjistro Notën">
            </div>
        </form>
    </div>
</body>

</html>
