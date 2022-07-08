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
    
    <!-- Style for the home page -->
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    
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

    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        color: white;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }

    section{
    background: url(assets/background.png) no-repeat;
    background-size: cover;
    height: calc(100vh - 80px);
    }
    footer{
       background: rgba(0,0,0,0.5);
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

    <!-- Welcoming user -->
    <h1>Welcome <?php echo $fetch_info['name'] ?></h1>

    <!-- for background -->
    <section></section>

    <footer>
    <span>Copyright | <span class="far fa-copyright"></span> Keeper 2022 |All rights reserved</span>
    </footer>

</body>
</html>