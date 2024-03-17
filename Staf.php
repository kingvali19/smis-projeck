<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
</head>

<body>
<div class="container">
<div class="navbar">
                <div class="nameweb">
                 <h3>SMIS</h3>   
                </div>
                <div class="navpage">
                    <ul>
            <li><a href="index.php">Home</a></li>
                        <li><a href="NewStaf.php">New Staf</a></li>
                        
                    </ul>
                </div>
            </div>
            <style>

            </style>

<h2>List of STAF</h2>


<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Profesioni</th>
        <th>Lenda</th>
    </tr>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smis";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select all students from the database
    $sql = "SELECT * FROM staf";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["profesion"] . "</td>";
            echo "<td>" . $row["lenda"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Nuk ka STAF.";
    }

    // Close the connection
    $conn->close();
    ?>
    

</table>
</div>


</body>
</html>
