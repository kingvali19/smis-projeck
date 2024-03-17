<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="Boots/JS.js"></script>
    <title>Lista e Notave për Studentin</title>
    <style>
       h3{
    text-decoration: none;
    list-style-type: none;
    color: inherit;
    }
    button{
        text-decoration: none;
    list-style-type: none;   
    }
    .role-selection {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    display: none;
    z-index: 1; /* Ensure the dropdown is on top of other content */
}

.user-link:hover .role-selection {
    display: block;
    background-color:#f9f9f9;
}

.role-option {
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    color: black;
}

.role-option:hover {
    background-color: #f1f1f1;
}

/* Styling for the cart icon */

.user-link {
    position: relative;
    display: inline-block;
    margin-right: 20px; /* Add spacing between user and cart icons */
}

.user-icon {
    color: #000; /* Icon color */
    font-size: 21px; /* Icon size */
    text-decoration: none;


}
#a:hover{
    background-color: lightgrey;
    font-style:italic;
}

    </style>
</head>

<body>



<div class="container">
<div class="navbar">
                <div class="nameweb">
      <h3>SMIS</h3></a>   

                </div>
                <div class="navpage">
                    <ul>
                  <div class="user-link">
                        
                    <a href="#" class="user-icon">   <i class="fa fa-user"></i></a>

                        <div class="role-selection">
                        <a href="AdvanceNewUser.php" class="role-option">Student</a>
                        <a href="nota.php" id="Us" class="role-option">Notat</a>
                        <a href="lenda.php" class="role-option">Lenda</a>
                        <a href="AdvanceUser.php" id="Us" class="role-option">Studentet</a>
                        
                        </div>

                  </div>
                  
                    </ul>
                </div>
            </div>
    
    </div>
</body>

</html>