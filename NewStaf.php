<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
// Kontrollojmë nëse është dorëzuar forma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kontrollojmë nëse janë dorëzuar të dhënat për emrin dhe mbiemrin
    if(isset($_POST['name'])  && isset($_POST['profesion']) && isset($_POST['lenda'])  ){
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smis";

        // Krijojmë lidhjen me bazën e të dhënave
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrollojmë lidhjen
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Merrim vlerat e emrit dhe mbiemrit nga forma
        $name = $_POST['name'];
        $profesion = $_POST['profesion'];
        $lenda = $_POST['lenda'];
        
        // Krijoni query-n për të shtuar studentin në bazën e të dhënave
        $sql = "INSERT INTO staf (name,profesion,lenda) VALUES ('$name', '$profesion','$lenda')";
        
        // Ekzekutojmë query-n dhe kontrollojmë nëse është ekzekutuar me sukses
        if ($conn->query($sql) === TRUE) {
            echo "Studenti u shtua me sukses.";
        } else {
            echo "Gabim gjatë shtimit të studentit: " . $conn->error;
        }

        // Mbyllim lidhjen me bazën e të dhënave
        $conn->close();
    }
}
?>
    

<div class="container">
    <div class="navbar">
        <div class="nameweb">
            <h3>SMIS</h3>
        </div>
        <div class="navpage">
            <ul>
                <li><a href="index.php">Home</a></li>
                
                <li><a href="Staf.php">Staf</a></li>
            </ul>
        </div>
    </div>

    <div class="bodyy">
        <style>
            form{
                margin:50px  auto;
                width: 300px;
                height: 300px;
                box-shadow: 1px 5px 5px black;
                padding-left: 50px ;
                border: 1px solid black;

            }label{
                align-items: center;
            }
        </style>
        <!-- Forma për të shtuar student -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Emri:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="profesion">Profesioni:</label><br>
            <input type="text" id="profesion" name="profesion" required><br>
            <label for="lenda">Lenda:</label><br>
            <input type="text" id="lenda" name="lenda" required><br><br>
            <button type="submit">Ruaj Studentin</button>
        </form>
    </div>
</div>

</body>
</html>
