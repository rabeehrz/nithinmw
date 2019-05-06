<?php
require 'db.php';
if(isset($_POST['username']) && isset($_POST['password'])) {
    $errors = array();
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $errors[] = "Please enter a username and password";
    } else {
        $sql = "SELECT * FROM users WHERE `username` = '" . $_POST['username']. "' AND `password` = '" . $_POST['password']. "'";
        $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['id'] = $row["id"];
                $_SESSION['username'] = $row["username"];
                $_SESSION['password'] = $row["password"];
            }
         } else {
            $errors[] = "Not found.";
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
    <h1>Login</h1>
    <?php
        if(!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
    ?>
    <?php
        if(isset($_SESSION['id'])) {
            ?>
            <p>Hello, <?php echo $_SESSION['username']?></p>
            <a href="logout.php">Logout</a>
            <?php
        } else {
    ?>
    <?php 
        if(isset($_GET['success'])) {
            echo "<p>Succefully registered. Please Login.</p>";
        }
    ?>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username"><br /><br />
        <input type="password" name="password" placeholder="Password"><br /><br />  
        <input type="submit" value="Submit">
    </form>
    <p>New user? <a href="register.php">Register</a></p>
        <?php } ?>
</body>
</html>