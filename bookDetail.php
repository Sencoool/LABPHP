<?php
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbName = "bookstore";

        $conn = mysqli_connect($hostname, $username, $password);
        if (!$conn) {
            die("Failed to connect to the database");
        }
        mysqli_select_db($conn, $dbName) or die("Can't choose database");
        mysqli_query($conn,"set character_set_connection=utf8mb4");
        mysqli_query($conn,"set character_set_client=utf8mb4"); // TH Language
        mysqli_query($conn,"set character_set_results=utf8mb4");
        if(isset($_GET['bookId'])) {   // checking if $_get is null or not and then get value book_id from URL
            $bookIdURL = $_GET['bookId']; // name need 2bt same with Var that declare in PHP
            $sql = "SELECT * FROM book WHERE BookID = $bookIdURL"; // SQL Command needs to be UPPERCASE And BookID here need 2bt same with SQL column name
            $result = mysqli_query ($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<h2>Book Details</h2>";
                echo "BookID: " . $row["BookID"] . "<br>";
                echo "BookName: " . $row["BookName"] . "<br>";
                echo "TypeID : " . $row["TypeID"] . "<br>";
                echo "StatusID: " . $row["StatusID"] . "<br>";
                echo "Publish: " . $row["Publish"] . "<br>";
                echo "UnitPrice: " . $row["UnitPrice"] . "<br>";
                echo "UnitRent: " . $row["UnitRent"] . "<br>";
                echo "DayAmount: " . $row["DayAmount"] . "<br>";
                echo "BookDate: " . $row["BookDate"] . "<br>";
                if(!empty($row['Picture'])) {
                    echo "<p><strong>Picture:</strong></p>";
                    echo "<img src='pictures/{$row['Picture']}'>"; // If image not showing mean that in DB URL length not long enough
                }
            } else {
                echo "ไม่พบข้อมูลหนังสือ";
            }
        } else {
            echo "ไม่มีค่าของ book_id ที่รับมา";
        }
        mysqli_close($conn);
    ?>
     <a href="/"></a>
     <p></p>
    <a href="bookList1.php">Back to List</a>