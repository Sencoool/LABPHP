<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movie</title>
</head>
<body>
    <?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "moviestore";
    $conn = mysqli_connect($hostname,$username,$password);
    if(!$conn){
        die("Fail connecting DB");
    }
    mysqli_select_db($conn,$dbName)or die("Can't select your DB");
    mysqli_query($conn, "set character_set_connection=utf8mb4");
    mysqli_query($conn, "set character_set_client=utf8mb4");
    mysqli_query($conn, "set character_set_results=utf8mb4");

    $movieID = $_GET['MovieID'];
    $sql = "DELETE FROM movies WHERE MovieID = $movieID";
    $result = mysqli_query($conn,$sql);
    
    header('Location: movies.php')
    ?>
    <h1>Hello</h1>
</body>
</html>