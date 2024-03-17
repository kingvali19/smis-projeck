<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Boots/CSS.css">

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
                        <li><a href="Newuser.php">New User</a></li>
                       
                    </ul>
                </div>
            </div>
            <style>

            </style>

<h2>List of Students</h2>


<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Mbiemri</th>
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
    $sql = "SELECT * FROM studentet";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["emri"] . "</td>";
            echo "<td>" . $row["mbiemri"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "Nuk ka studentë.";
    }

    // Close the connection
    $conn->close();
    ?>
    

</table>
</div>


</body>
</html>
