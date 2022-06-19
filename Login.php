<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $passwordErr =  "";
$name = $password =  "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = $_POST["name"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
    if (strlen($_POST["name"]) <= '2') {
            $nameErr = "Your Name Must Contain At Least 2 Characters!";
        }
  }
  
  if(!empty($_POST["password"])) {
    $passwordErr ="Password is Required" ;
    
    if (strlen($_POST["password"]) <= '8') {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
    }
    
    elseif(!preg_match("/[\'^£$%&*()}{@#~?><,|=_+¬-]/",$password)) {
        $passwordErr= "Your Password Must Contain At Least 1 Special Character !";
    }
    
}
 else {
     $passwordErr = "Please enter password   ";
} 
}


?>

<h2>Login</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="text" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="Checkbox" id="Checkbox1" name="Remember Me" value="Remember ME">
  <label for="Checkbox1"> Remember Me</label><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>