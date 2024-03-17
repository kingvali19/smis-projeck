<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php include('header.php');?>

<div class="container">
 
    <div class="bodyy" >
        <div class="row"  >
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "smis";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM advancestudentet";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3" style="margin-top:20px;">
                        <div class="card" style="width: 15rem; ">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['foto']); ?>" class="card-img-top" style="height: 14rem;" alt="Student Image">
                            <div class="card-body"><br>
                                <h5 class="card-title"><?php echo ucfirst($row['emri']) . ' ' . ucfirst($row['mbiemri']); ?></h5>
                                <p class="card-text">Personal ID: <strong><?php echo $row['personal_id']; ?></strong></p>
                                <a href="tegjitha.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Check User</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Nuk ka studentë të regjistruar.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>


</body>
</html>
