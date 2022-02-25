<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Music Submission Form</title>
</head>

<body>
    <div class="submit_box">
        <form method="GET" action="">
            Username: <input id="username" type="text" name="username" placeholder="Enter your username" /><br>
            <input id="submission" type="submit" name="submit" value="Submit" />
            <p><?php
                ?>
            </p>
    </div>
    <div class="phpStyle">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "music-db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_REQUEST["submit"])) {
            $out_value =  "";
            $s_username = $_REQUEST['username'];

            if (!empty($s_username)) {
                $sql_query = "SELECT * FROM ratings WHERE username = ('$s_username')";
                $result = mysqli_query($conn, $sql_query);
                while ($row = mysqli_fetch_array($result)) {
                    $out_value =  $row['song'] . " --> " . $row['ratings'] . "<br>";
                    echo $out_value;
                }
            } else {
                echo $out_value = "No songs available";
            }
        }
        $conn->close();
        ?>
    </div>
</body>

</html>