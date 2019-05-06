<?php
require 'db.php';
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
    $errors = array();
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])) {
        $errors[] = "All fields are required.";
    } else {
        if($_POST['password'] != $_POST['password2']) {
            $errors[] = "Password do not match.";
        } else {
            $sql = "SELECT * FROM users WHERE `username` = '" . $_POST['username']. "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $errors[] = "User already exists.";
            } else {
                $sql = "INSERT INTO users (username,password) VALUES ('".$_POST['username']."','".$_POST['password']."')";
                if (mysqli_query($conn, $sql)) {
                    header('Location: index.php?success');
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                }
            }
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Register</h1>
    <?php
        if(!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
    ?>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username"><br /><br />
        <input type="password" name="password" placeholder="Password"><br /><br />   
        <input type="password" name="password2" placeholder="Re-enter password"><br /><br />  
        <input type="submit" value="Register">
    </form>
</body>
</html>