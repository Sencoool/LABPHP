<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movie</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php
    session_start();
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

    $sql = "SELECT * FROM movies WHERE MovieID = $MovieID";
    $data = mysqli_query($conn,$sql);
    $eachdata = mysqli_fetch_assoc($data);
    ?>
    <h1>Update Movie</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $eachdata['Title'] ?>">
        <br>
        <label for="author">Director:</label>
        <input type="text" id="director" name="director" value="<?php echo $eachdata['Director'] ?>">
        <br>
        <label for="years">Year:</label>
        <input type="text" id="year" name="year" value="<?php echo $eachdata['Years'] ?>">
        <br>
        <label for="start">Start Date:</label>
        <input type="date" id="start" name="start" value = "<?php echo $eachdata['StartDates'] ?>">
        <br>
        <label for="end">End Date:</label>
        <input type="date" id="end" name="end" value = "<?php echo $eachdata['EndsDates'] ?>">
        <br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <br>
        <input type="submit" value="update" name="update">
    </form>
    <?php
    if(isset($_POST['update'])){
        $title = $_POST['title'];
        $director = $_POST['director'];
        $year = $_POST['year'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $imageName = @$_FILES['image']['name'];
        $imageType = @$_FILES['image']['type'];
        $imageSize = @$_FILES['image']['size'];
        $imageTmpName = @$_FILES['image']['tmp_name'];
        $image = "";

        if($_FILES["image"]["name"] == ""){
        }else{
            move_uploaded_file($_FILES['image']['tmp_name'],"image/".$_FILES["image"]['name']);
            $image = $_FILES['image']['name'];
        }

        $startobj = new DateTime($start);
        $endobj = new DateTime($end);

        if($endobj > $startobj){
            $interval = $endobj->diff($startobj);

            $day = $interval->days; // วัน
            // $month = $interval->m; // เดือน
            // $year = $interval->y; // ปี
    
            $sql = "UPDATE movies SET Title = '$title', Director = '$director', Years = '$year', StartDates = '$start', EndsDates = '$end', IntervalDays = '$day', Image = '$image' WHERE MovieID = $MovieID";
            $result = mysqli_query($conn, $sql);
            if($result){
                header('Location: movies.php');
            }else {
                echo "Failed to updated movie.";
            }
        }else{
            echo "<br><center>กรุณาใส่เวลาเริ่มและสิ้นสุดการฉายให้ถูกต้อง</center>";
        }
    }
    ?>
    <a href="movie.php?MovieID=<?php echo $MovieID ?>">Back to Movie info</a>
</body>
</html>