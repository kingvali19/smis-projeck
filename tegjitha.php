<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Të Gjitha Të Dhënat e Studentit</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .student-info {
            margin-top: 20px;
        }
        .student-info img {
            height: 200px;
        }
        .grade-info {
            margin-top: 20px;
           
        }
        .grade-info p {
      text-align: center;
            margin-top: 5px;
            padding: 2px;
            border: 1px solid black;
            width: 150px;
        }.average-info p{
            text-align: center;
            margin-top: 5px;
            padding: 2px;
            border: 2px solid black;
            width: 150px;
        }
        .s-info{
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            
        }.students-info{
            margin-left:40px ;
        }

    </style>
</head>
<body> 
<?php include('header.php'); ?>
<div class="container">
    <div class="row">
        <div class="student-info" style="margin: 10px auto;">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "smis";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Student ID
            if (isset($_GET['id'])) {
                $student_id = $_GET['id'];

                // Fetch student information
                $sql_student = "SELECT * FROM advancestudentet WHERE id = $student_id";
                $result_student = $conn->query($sql_student);

                if ($result_student->num_rows > 0) {
                    while ($row_student = $result_student->fetch_assoc()) {
                        // Display student information
                        echo "<div class='s-info'>";
                        echo "<div class='simg-info'>";
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row_student['foto']) . "' alt='Student Image'>";
                        echo "</div>";
                        echo "<div class='students-info'>";
                        echo "<h2>" . ucfirst($row_student['emri']) . " " . ucfirst($row_student['mbiemri']) . "</h2>";
                        echo "<p style='font-weight: bold;'>ID: " . $row_student['id'] . "</p>";
                        echo "<p style='font-weight: bold;'>Email: " . $row_student['email'] . "</p>";
                        echo "<p style='font-weight: bold;'>Phone: " . $row_student['phone'] . "</p>";
                        echo "</div>";
                        echo "</div>";

                        // Fetch and display student's grades
                        $sql_studentgrades = "SELECT sg.grade, l.language_name 
                                              FROM studentgrades sg 
                                              JOIN language l ON sg.id = l.id 
                                              WHERE sg.advancestudentet_id = $student_id";
                        $result_studentgrades = $conn->query($sql_studentgrades);
                        if ($result_studentgrades->num_rows > 0) {
                            echo "<div class='grade-info'>";
                            while ($row_studentgrades = $result_studentgrades->fetch_assoc()) {
                                echo "<p style='font-weight: bold;'>" . $row_studentgrades['language_name'] . ": " . $row_studentgrades['grade'] . "</p>";
                            }
                            echo "</div>";
                        } else {
                            echo "<p class='grade-info'>Nuk ka notë për këtë student.</p>";
                        }

                        // Calculate and display student's grade average
                        $sql_average_grade = "SELECT AVG(grade) AS average_grade FROM studentgrades WHERE advancestudentet_id = $student_id";
                        $result_average_grade = $conn->query($sql_average_grade);
                        if ($result_average_grade->num_rows > 0) {
                            $row_average_grade = $result_average_grade->fetch_assoc();
                            $average_grade = number_format($row_average_grade['average_grade'], 2); // Format average grade to two decimal places
                    
                            echo "<div class='average-info'>";
                            echo "<p style='font-weight: bold;'>Average: " . $average_grade . "</p>";
                            echo "</div>";

                        }
                    }
                } else {
                    echo "<p class='student-info'>Nuk ka rezultate për këtë ID.</p>";
                }
            } else {
                echo "<p class='student-info'>ID nuk është specifikuar në URL.</p>";
            }


            
            // Close database connection
            $conn->close();
            ?>
            
        </div>
    </div>
</div>

<!-- <?php

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
    $language_id = $_POST['language'];
    $grade = $_POST['grade'];

    // Shtimi i notës në bazën e të dhënave
    try {
        $query = "INSERT INTO grade (advancestudentet_id, language_id, grade) VALUES (:advancestudentet_id, :language_id, :grade)";
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
?>
<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi i Notës</title>
</head>

<body>
<div class="container">
    <h2>Regjistrimi i Notës</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="advancestudentet">Studenti:</label><br>
        <select id="advancestudentet" name="advancestudentet">
            <?php foreach ($advancestudentets as $advancestudentet) : ?>
                <option value="<?php echo $advancestudentet['advancestudentet']; ?>"><?php echo $advancestudentet['emri'] . ' ' . $advancestudentet['mbiemri']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="languages">Lënda:</label><br>
        <select id="languages" name="languages">
            <?php foreach ($languages as $language) : ?>
                <option value="<?php echo $language['language_id']; ?>"><?php echo $language['language_name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="nota">Nota:</label><br>
        <input type="number" id="nota" name="nota" min="5" max="10"><br><br>
        <input type="submit" value="Regjistro Notën">
    </form>
</div>
</body>

</html> -->


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

// Merrni të gjithë studentët nga tabela "advancestudentet"
try {
    $query = "SELECT * FROM advancestudentet";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $advancestudentets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Merrni të gjitha lëndët nga tabela "language"
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
    $grade = $_POST['nota'];

    // Shtimi i notës në bazën e të dhënave
    try {
        $query = "INSERT INTO studentgrades (advancestudentet_id, language_id, grade) VALUES (:advancestudentet_id, :language_id, :grade)";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi i Notës</title>
</head>
<style>
    .containeri{
        
    }form{
        margin:50px auto;
        width: 300px;
        height: 400px;
    }
    .style{
        margin: 20px 50px;
    }
</style>

<body>
<div class="container">
    
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h2>Regjistrimi i Notës</h2>
    <div class="style">
        <label for="advancestudentet">Studenti:</label><br>
        <select id="advancestudentet" name="advancestudentet" class="form-select">
    <?php foreach ($advancestudentets as $advancestudentet) : ?>
        <?php $selected = ($advancestudentet['id'] == $_POST['advancestudentet']) ? 'selected' : ''; ?>
        <option value="<?php echo $advancestudentet['id']; ?>" <?php echo $selected; ?>><?php echo ucfirst($advancestudentet['emri']) . ' ' . ucfirst($advancestudentet['mbiemri']); ?></option>
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



</body>
</html>
