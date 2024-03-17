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
    <?php include('header.php');?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['emri']) && isset($_POST['mbiemri'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smis";

        $conn = new mysqli($servername, $username, $password, $dbname); 

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $personal_id = $_POST['personal_id']; // Fixed typo $POST to $_POST
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Për të ruajtur fotografinë
        $foto = addslashes(file_get_contents($_FILES['imageUpload']['tmp_name']));

        $sql = "INSERT INTO advancestudentet (personal_id, emri, mbiemri, email, phone, foto) VALUES ('$personal_id', '$emri', '$mbiemri','$email','$phone', '$foto')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='students-info'>";
            echo "Studenti u shtua me sukses.";
            echo "</div>";

        } else {
            echo "Gabim gjatë shtimit të studentit: " . $conn->error;
        }

        $conn->close();
    }
}
?>
 <style>
         .card {
            margin: 50px auto;
            
        }.card img{
            display: flex;
            flex-direction: row;
        }
        .custom-file-upload input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
        }
        #uploadPreview {
            cursor: pointer;
        }.card-body{
            margin: auto;
        }.students-info{
            text-align: center;
            color: green;
        }
    </style>


<div class="container">
    

<div class="bodyy">
    <form action="AdvanceNewUser.php" method="post" enctype="multipart/form-data">
        <div class="card" style="width:18rem;">
            <label for="imageUpload" class="custom-file-upload">
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*" onchange="previewImage(event)">
                <img id="uploadPreview" src="https://via.placeholder.com/100" class="card-img-top" alt="Preview Image">
            </label>

            <div class="card-body">
            <label for="personal_id">Personal ID:</label><br>
                <input type="number" id="personal_id" name="personal_id" required><br>

                <label for="emri">Emri:</label><br>
                <input type="text" id="emri" name="emri" required><br>

                <label for="mbiemri">Mbiemri:</label><br>
                <input type="text" id="mbiemri" name="mbiemri" required><br>

                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" required><br>

                <label for="phone">Tel:</label><br>
                <input type="tel" id="phone" name="phone" required><br><br>

                <button type="submit">Ruaj Studentin</button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('uploadPreview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
