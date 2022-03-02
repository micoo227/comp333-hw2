<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Music Submission Form</title>
</head>

<body>
    <div>
        <h1>
            music-db
        </h1>
    </div>

    <div>
        <form class="form" action="" method="POST">
            <h2>Registration</h2>
            <span>Username: <input type="text" name="username" required /></span>
            <span>Password: <input type="password" name="password" /></span>
            <span><input type="submit" name="register" value="Register"></span>
        </form>
    </div>

    <div>
        <form method="GET" action="">
            Username: <input id="username" type="text" name="username" placeholder="Enter your username" /><br>
            <input id="submission" type="submit" name="submit" value="Submit" />
            <p><?php
                ?>
            </p>
        </form>
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

        // if user registers new account (presses register button)
        if (isset($_POST['register'])) {
            $out_value = "";
            // store recorded information in variables
            $username = $_POST['username'];
            $password = $_POST['password'];

            // verify that the user entered the info properly
            if (!empty($username) and !empty($password)){
                // query the database to see if the username is taken
                $sql_query = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql_query);
                if (mysqli_num_rows($result) == 0){
                    // insert the user into the database
                    $sql_query = "INSERT INTO users VALUES ('$username', '$password')";
                    mysqli_query($conn, $sql_query);

                    // verify that the account was created
                    $sql_query = "SELECT * FROM users WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql_query);
                    if (mysqli_num_rows($result) == 1){
                        echo $out_value = "Account created successfully.";
                    }
                    else{
                        echo $out_value = "An error occurred and your account was not created. Please try again.";
                    }
                }
                else {
                    echo $out_value = "This username is already taken. Please try again.";
                }
            }
            else{
                echo $out_value = "Please complete the required fields.";
            }
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