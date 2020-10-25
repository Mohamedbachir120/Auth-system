<?php

session_start();

if(isset($_SESSION["email"])){

    header("Location:home.php");
}

function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
  
    return $data;
  }
  $tab_exist=[];
  $con=mysqli_connect("localhost", "root", "", "DINO") or die("erreur connexion mysqli");

  $var=mysqli_query($con,"SELECT * from USER");
  if (mysqli_num_rows($var) > 0) {
      
      while($row = mysqli_fetch_assoc($var)) {
   
        $tab_exist[$row["Email"]]=$row["password"];
      
    
    }
      
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Myform">

<label for="email">Email</label>
<input type="email" name="email" id="email" required>
<label for="password"> Password </label>
<input type="password" name="password" id="password" required>

<input type="submit" value="se connecter" id="submit" name="submit">


<a href="subscribe.php"> S'inscrire</a>
</form>    
</body>
</html>

<?php
$tab=[];
$tab["email"]=isset($_POST['email']) ? test_input($_POST['email']) : NULL;
$tab["password"]=isset($_POST['password']) ? test_input($_POST['password']) : NULL;
$email=$tab["email"];
$password=$tab["password"];

if(isset($_POST["submit"])){
if(array_key_exists($email,$tab_exist)){
if($tab_exist[$email]==$password){
    $_SESSION["email"]=$email;
    header("Location:home.php");
}else{

    echo"<script language=\"javascript\">";
    echo"alert('Incorrect password')";
    echo"</script>";

}}
else{
    echo"<script language=\"javascript\">";
    echo"alert('Email incorrect')";
    echo"</script>";


}

}


?>
