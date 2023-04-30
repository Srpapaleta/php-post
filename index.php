<?php
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Welcome to my site</h2>
        <label for="">username</label><br>
        <input type="text" name="username"><br>
        <label for="">password</label><br>
        <input type="password" name="password"><br>
        <input type="submit"  name= "submit" value="Register">
    </form>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)){
            echo"Please introduce a username";
        }else if(empty($password)){
            echo"Please introduce a password";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
            mysqli_query($conn, $sql);
            echo"You are now registered";
        }
    }

    mysqli_close($conn);
?>
