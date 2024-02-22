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
        mysqli_query($conn,"set character_set_client=utf8mb4");
        mysqli_query($conn,"set character_set_results=utf8mb4");
        if(isset($_GET['bookId'])) {   // checking if $_get is null or not and then get value book_id from URL
        $bookIdURL = $_GET['bookId']; // name need 2bt same with Var that declare in PHP
        $sql = "select * from book where id = $bookIdURL";
        $result = mysqli_query ($conn, $sql);
            echo "ค่าของ book_id ที่รับมาคือ: " . $bookIdURL;
        } else {
            echo "ไม่มีค่าของ book_id ที่รับมา";
        }
        // if(isset($_GET['bookId'])) {
        //     $bookId = $_GET['bookId'];
        //     $sql = "SELECT * FROM book WHERE bookId = $bookId";
        //     $result = mysqli_query($conn, $sql);
        //     if(mysqli_num_rows($result) > 0) {
        //         $row = mysqli_fetch_assoc($result);
        //         echo "<h2>Book Details</h2>";
        //         echo "<p><strong>Book ID:</strong> {$row['BookID']}</p>";
        //         echo "<p><strong>Book Name:</strong> {$row['BookName']}</p>";
        //         echo "<p><strong>Type ID:</strong> {$row['TypeID']}</p>";
        //         echo "<p><strong>Status ID:</strong> {$row['StatusID']}</p>";
        //         echo "<p><strong>Publish:</strong> {$row['Publish']}</p>";
        //         echo "<p><strong>Unit Price:</strong> {$row['UnitPrice']}</p>";
        //         echo "<p><strong>Unit Rent:</strong> {$row['UnitRent']}</p>";
        //         echo "<p><strong>Day Amount:</strong> {$row['DayAmount']}</p>";
        //         echo "<p><strong>Book Date:</strong> {$row['BookDate']}</p>";
        //         if(!empty($row['Picture'])) {
        //             echo "<p><strong>Picture:</strong></p>";
        //             echo "<img src='pictures/{$row['Picture']}'";
        //         }
                
        //     } else {
        //         echo "No book found with the provided ID.";
        //     }
        // } else {
        //     echo "No book ID provided.";
        // }

        mysqli_close($conn);
    ?>
     <a href="/"></a>
    <a href="bookList1.php">Back to List</a>