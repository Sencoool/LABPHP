<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Movies</title>
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

    $MovieID = $_GET['MovieID'];

    $sql = "select * from movies WHERE MovieID = $MovieID";
    $movies = mysqli_query($conn, $sql);
    ?>
    <h1>Movies</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Director</th>
            <th>Years</th>
            <th>Start Dates</th>
            <th>Ends Dates</th>
            <th>Showing Days</th>
            <th>Image</th>
        </tr>
        <?php while($eachmovie = mysqli_fetch_assoc($movies)){ ?>
        <tr>
            <td><?php echo $eachmovie['Title']; ?></td>
            <td><?php echo $eachmovie['Director']; ?></td>
            <td><?php echo $eachmovie['Years']; ?></td>
            <td><?php echo $eachmovie['StartDates']; ?></td>
            <td><?php echo $eachmovie['EndsDates']; ?></td>
            <td><?php echo $eachmovie['IntervalDays']; ?></td>
            <?php if($eachmovie['Image'] == ""){ ?>
            <td>ไม่มีรูปสำหรับหนังเรื่องนี้</td>
            <?php } else { ?>
            <td><img src="image/<?php echo $eachmovie['Image'] ?>" alt=""></td>
            <?php }?>
        </tr>
        <?php } ?>
    </table>
    <br><center>
        <p><?php echo $_SESSION['Username'] ?></p>
        <a href="movieupdate.php?MovieID=<?php echo $MovieID ?>">Update</a>
        <a href="moviedelete.php?MovieID=<?php echo $MovieID ?>">Delete</a>
        <a href="movies.php">Back to all movies</a>
    </center>
</body>
</html>