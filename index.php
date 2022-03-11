<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded" />
    <link rel="stylesheet" type="text/css" href="style1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Music Submission Form</title>
</head>

<body>
    <div class="formContainer">
        <div class="formHead">
            <h1>
                Retrieve your Music Ratings!
            </h1>
        </div>
        <div>
            <form method="GET" action="">
                <br>
                Username: <input id="username" type="text" name="username" /><br>
                <br>
                <input id="submission" type="submit" name="submit" value="Retrieve" />
                <p><?php
                    ?>
                </p>
            </form>
            <br>
            <div class="submissionPHP">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "music-db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                //This is the php responsible for retrieving the song ratings
                if (isset($_REQUEST["submit"])) {
                    $out_value =  "";
                    $s_username = $_REQUEST['username'];
    
                    //Php for comparing the input username and the username within the databse
                    if (!empty($s_username)) {
                        $sql_query = "SELECT * FROM ratings WHERE username = ('$s_username')";
                        $result = mysqli_query($conn, $sql_query);
                        while ($row = mysqli_fetch_array($result)) {
                            $out_value =  $row['song'] . " --> " . $row['ratings'] . "<br>";
                            echo $out_value;
                        }

                    //If user hit submitted witout entering anything, it produces the following message.
                    } else {
                        echo $out_value = "No songs available";
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div>
            <form class="form" action="" method="POST">
                <br>
                <hr>
                <br>
                <h2>New User?</h2>
                <br>
                <h3>Sign Up</h3>
                <br>
                <span>Username: <input id="user_register" type="text" name="username" required /></span>
                <br>
                <br>
                <span>Password: <input id="pass_register" type="password" name="password" /></span>
                <br>
                <br>
                <span><input id="register" type="submit" name="register" value="Register"></span>
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
                if (!empty($username) and !empty($password)) {
                    // query the database to see if the username is taken
                    $sql_query = "SELECT * FROM users WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql_query);
                    if (mysqli_num_rows($result) == 0) {
                        // insert the user into the database
                        $sql_query = "INSERT INTO users VALUES ('$username', '$password')";
                        mysqli_query($conn, $sql_query);

                        // verify that the account was created
                        $sql_query = "SELECT * FROM users WHERE username = '$username'";
                        $result = mysqli_query($conn, $sql_query);
                        if (mysqli_num_rows($result) == 1) {
                            echo $out_value = "Account created successfully.";
                        } else {
                            echo $out_value = "An error occurred and your account was not created. Please try again.";
                        }
                    } else {
                        echo $out_value = "This username is already taken. Please try again.";
                    }
                } else {
                    echo $out_value = "Please complete the required fields.";
                }
            }
            ?>
        </div>

    </div>


</body>

</html>