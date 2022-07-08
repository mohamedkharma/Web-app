<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>

            body {
                font-family: 'Roboto', sans-serif;
            }

            #create-form, #update-form, #delete-form {
                display: none;
            }

            .main-div {
                width: 80vw;
                margin: 0 auto;
            }

            h2 {
                text-align: center;
            }

            table {
                margin: 15px auto;
                width: 50vw;
                text-align: center;
            }

            table tr td {
                padding: 12px; 
            }

            .content-wrapper {
                width: 100%;
                margin: 0 auto;
                text-align: center;
            }

            #create-button, #update-button, #delete-button {
                width: 140px; 
                height: 37.5px;
                background-color: gray; 
                color: #FFFFAA; 
                border-radius: 4px; 
                border: 1.5px solid black; 
                letter-spacing: 1.5px; 
                cursor: pointer 
            }

            .small-button {
                width: 76px;
                height: 30px;
                background-color: gray;
                color: #FFFFAA;
                border-radius: 2px; 
                border: none; 
                cursor: pointer
            }

            input[type="text"] {
                margin: 6px; 
                width: 260px;
                height: 32px;
                padding: 3px
                
            } 
            label.logo{
                color: white;
                font-size: 35px;
                line-height: 30px;
                padding: 0 100px;
                font-weight: bold;
            }
     
            nav ul{
                float: right;
                margin-right: 20px;
            }
            nav ul li{
                display: inline-block;
                line-height: 80px;
                margin: 0 5px;
            }
            nav ul li a{
                color: white;
                font-size: 17px;
                padding: 7px 13px;
                border-radius: 3px;
                text-transform: uppercase;
            }

            nav{
                padding-left: 100px!important;
                padding-right: 100px!important;
                background: #6665ee;
                font-family: 'Poppins', sans-serif;
            } 
            section{
                background: url(assets/bac.png) no-repeat;
                background-size: cover;
                height: calc(100vh - 80px);
            }
            footer{
                background: rgba(0,0,0,0.5);
                position: absolute;
                bottom: 0;
            }

        </style>         
    </head>
    <body>
            <!--NAVIGATION BAR-->
    <nav class="navbar">
    <label class="logo">Keeper</label>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="index.php">My List</a></li>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </ul>
    </nav>


        <div class="main-div">
            <?php require_once 'create.php';?>
            <div>
                <h2>Your Favorite Movies List</h2>
                <?php
                    $servername = 'localhost';
                    $username = 'root';
                    $password = '';
                    $databasename = 'database';
                
                    //Creating a connection to database            
                    $connection = mysqli_connect($servername, $username, $password, $databasename);
                    
                    //Check if connection was successful or not 
                    if(!$connection){
                        die ('Connection unsuccessful :'.mysqli_connect_error());
                    }

                    //$id = "SELECT * FROM usertable WHERE id =1";
                    
                    //Query the table for the records 
                    $sql = "SELECT * FROM movieflix_table";//set up our query 
                    
                    // $sql = "SELECT * FROM movieflix_table WHERE login_id = 1";//set up our query 
                    // THis works only with specific login_id---> try to see how to get the current user id and add it here

                    $result = mysqli_query($connection, $sql); //store the result of our query into the $result 
                    $rowCount = mysqli_num_rows($result); //Method returns to us the number of rows -> $rowCount

                    if($rowCount > 0){
                        echo "
                            <table>
                                <thead>
                                    <tr>
                                        <th>Record ID</th>
                                        <th>Title</th>
                                        <th>Genre</th>
                                        <th>Director</th>
                                    </tr>
                                </thead>
                        ";
                    }
                ?><!--End PHP code block-->
                <?php 
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['genre'] ?></td>
                            <td><?php echo $row['director'] ?></td>
                        </tr>
                    <?php endwhile;
                    ?>
                </table> 


            </div>
            <div class="content-wrapper">
                <button id="create-button">Create Record</button>
                <button id="update-button">Edit Record</button>
                <button id="delete-button">Delete Record</button>

                <form action="create.php" method="POST" id="create-form">
                    <input type="text" placeholder="Enter movie title" name="create-title"/><br />
                    <input type="text" placeholder="Enter movie genre" name="create-genre"/><br />
                    <input type="text" placeholder="Enter movie director" name="create-director"/><br />
                    <input type="submit" value="Save" name="create-button" class="small-button"/>
                </form> 

                <form action="update.php" method="POST" id="update-form">
                    <input type="text" placeholder="Enter Record ID" name="update-ID"/><br />
                    <input type="text" placeholder="Enter movie title" name="update-title"/><br />
                    <input type="text" placeholder="Enter movie genre" name="update-genre"/><br />
                    <input type="text" placeholder="Enter movie director" name="update-director"/><br />
                    <input type="submit" value="Save" name="submit-update" class="small-button" >
                </form>    

                <form action="delete.php" method="POST" id="delete-form">
                    <input type="text" placeholder="Enter Record ID" name="delete-ID"/><br /> 
                    <input type="submit" value="Save" name="submit-delete" class="small-button">
                </form>    
            </div>
        </div>
        <script src="script.js"></script>

        <footer>
        <span>Copyright | <span class="far fa-copyright"></span> Keeper 2022 |All rights reserved⠀⠀⠀⠀</span>
        </footer>
    </body>
</html>