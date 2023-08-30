<html>
<body>
<head>
<style>
    .error{color: red;}
</style>
</head>
<h> Log into an account! </h>



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

        $sql = $conn->query("SELECT username FROM users WHERE username = '$name'");
        if(mysqli_num_rows($sql) == 0){
            $nameErr = "Username doesn't match with any existing accounts";
        }


    }

    if (empty($_POST["pwd"])) {
        $pwdErr = "Password is required";
    } else {
        $pwd = test_input($_POST["pwd"]);


        $sql = $conn->query("SELECT username, password FROM users WHERE username = '$name' AND password = '$pwd'");
        if(mysqli_num_rows($sql) == 0){
            $pwdErr = "Username or password does not match!";
        }
    }

    if(empty($pwdErr) && empty($nameErr)){
        $_SESSION['userName'] = $_REQUEST['name'];
        $_SESSION['passWord'] = $_REQUEST['pwd'];

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


<a href="register.php">Need an account?</a>



</body>
</html> 