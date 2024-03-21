<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Movie</title>
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

    if(isset($_POST['create'])){
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
            echo "คุณไม่ได้ใส่รูปภาพ";
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
    
            $sql = "INSERT INTO movies(Title,Director,Years,StartDates,EndsDates,IntervalDays,Image) values ('$title','$director','$year','$start','$end','$day','$image')";
            mysqli_query($conn, $sql) or die("Error" .mysqli_error($conn));
            header('Location: movies.php');
        }else{
            echo "<center>!กรุณาใส่เวลาเริ่มและสิ้นสุดการฉายให้ถูกต้อง</center>";
        }
    }
    ?>
    <h1>Create Movie</h1>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        <br>
        <label for="author">Director:</label>
        <input type="text" id="director" name="director">
        <br>
        <label for="years">Year:</label>
        <input type="text" id="year" name="year">
        <br>
        <label for="start">Start Date:</label>
        <input type="date" id="start" name="start">
        <br>
        <label for="end">End Date:</label>
        <input type="date" id="end" name="end">
        <br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <br>
        <input type="submit" value="create" name="create">
    </form>
    <a href="movies.php">Back to Movie List</a>
</body>
</html>