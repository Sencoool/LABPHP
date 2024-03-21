<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "moviestore";
    $conn = mysqli_connect($hostname,$username,$password);
    if(!$conn)die("Can't connect to SQL");
    mysqli_select_db($conn,$dbname)or die("Can't connect to the DB");
    mysqli_query($conn,"set character_set_connection=utf8mb4");
    mysqli_query($conn,"set character_set_client=utf8mb4");
    mysqli_query($conn,"set character_set_results=utf8mb4");

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        $sql = "SELECT * FROM user WHERE Username = '$username'";
        $result = mysqli_query($conn, $sql) or die("Error" .mysqli_error($conn));
        $data = mysqli_fetch_assoc($result);
        if($data){
            if($data['Password'] == $password){
                header('Location: movies.php');
                $_SESSION['Username'] = $username;
            }else{
                echo "รหัสผ่านไม่ถูกต้อง";
            }
        }else{
            echo "ข้อมูลไม่ถูกต้อง";
        }
        
    }
    ?>
    <h1>User Login</h1>
    <form action="#" method="post">
        <label for="title">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="author">Password:</label>
        <input type="text" id="password" name="password">
        <br>
        <input type="submit" value="login" name="login">
    </form>
    <a href="movies.php">Back to Movie List</a>
    <a href="register.php">Register</a>
</body>
</html>