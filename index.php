<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="Boots/JS.js"></script>
        <title>SMIS UBT</title>
    </head>
    <body>
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
#Us{
  box-shadow: 0px 1px 0px 0px  rgb(46, 25, 25);

}
#a:hover{
    background-color: lightgrey;
    font-style:italic;
}

</style>

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
                        <a href="Newuser.php" class="role-option">NewUser</a>
                        <a href="User.php" id="Us" class="role-option">Users</a>
                        <a href="NewStaf.php" class="role-option">NewStaf</a>
                        <a href="Staf.php" id="Us" class="role-option">Staf</a>
                        <a href="AdvanceNewUser.php" id="a" class="role-option">AdNewUser</a>
                        <a href="AdvanceUser.php" id="a" class="role-option">AdUser</a>
                        </div>

                  </div>
                  
                    </ul>
                </div>
            </div>

            <div class="body">
                <img src="Image/25443098_1689032667814664_3854205562430223938_n.jpg" style="width: 100%;height: 650px;" alt="" >

                    <pre>UBT SMIS Check Our 
Students</pre>
                 <a href="User.php"><button>View Students</button></a>   
               
            </div>

            <div class="footer">
                <div class="text">
                    <pre>
                        Welcome to the best to be the best
                    </pre>
                </div>
                <div class="footer-logo">
                    <img src="Image/ubtlogo.jpg" alt="" style="margin:40 200px;">
                </div>
            </div>


        </div>

    </body>
</html>