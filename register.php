<html>
<body>
<head>
<style>
    .error{color: red;}
</style>
</head>
<h> Register for an account! </h>



<?php
require_once 'C:\Users\Lunkm\Reward System Test\dataBaseConnect.php';
session_start();
$nameErr = $pwdErr = "";
$name = $pwd = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
        $sql = $conn->query("SELECT username FROM users WHERE username = '$name'");
        if(mysqli_num_rows($sql) > 0){
            $nameErr = "Username already taken";
        }


    }

    if (empty($_POST["pwd"])) {
        $pwdErr = "Password is required";
    } else {
        $pwd = test_input($_POST["pwd"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$pwd)) {
            $pwdErr = "Only letters and white space allowed";
        }
    }

    if(empty($pwdErr) && empty($nameErr)){
        $_SESSION['userName'] = $_REQUEST['name'];
        $_SESSION['passWord'] = $_REQUEST['pwd'];
        $conn->query("INSERT INTO users (username, password, points) VALUES('$name','$pwd', 0)");

        header("Location: loggedIn.php");
    }
}
?> 

<p><span class ="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

Name: <input type = "text" name="name" value="<?php echo $name;?>">
<span class ="error">* <?php echo $nameErr;?></span>
<br><br>

Password: <input type = "text" name="pwd" value="<?php echo $pwd;?>">
<span class ="error">* <?php echo $pwdErr;?></span>
<br><br>


<input type="submit">
</form>


<a href="login.php">Already have an account?</a>



</body>
</html> 