<?php
session_start();
if(isset($_SESSION["email"])){

header("Location:home.php");

}


?>


<?php

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
   
        array_push($tab_exist,$row["email"]);
      
    
    }
      
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Myform">

<h2> S'inscrire </h2>
<label for="name">Name</label>
<input type="text" id="name" name="name" required>
<label for="last_name"> Last Name</label>
<input type="text" name="last_name" id="last_name" required>
<label for="email"> Email</label>
<input type="email" name="email" id="email" required>

<label for="password"> Password </label>
<input type="password" name="password" id="password" required>
<input type="submit" value="s'inscrire" id="submit" name="submit">


<a href="login.php"> Se connecter</a>

 </form>

</body>
</html>

<?php 
$tab=[];

$tab["name"]=isset($_POST['name']) ? test_input($_POST['name']) : NULL;

$tab["last_name"]=isset($_POST['last_name']) ? test_input($_POST['last_name']) : NULL;
$tab["email"]=isset($_POST['email']) ? test_input($_POST['email']) : NULL;
$tab["password"]=isset($_POST['password']) ? test_input($_POST['password']) : NULL;

$name=$tab["name"];
$last_name=$tab["last_name"];
$email=$tab["email"];
$password=$tab["password"];

if(isset($_POST["submit"])){
    
    if(in_array($email,$tab_exist)==false){
    $con=mysqli_connect("localhost", "root", "", "DINO") or die("erreur connexion mysqli");
    $id=mysqli_query($con,"INSERT INTO USER VALUES(null,'$name','$last_name','$email','$password')");
    echo"<script language=\"javascript\">";
        echo"alert('User added Successfully  ')";
        echo"</script>";

  
        $_SESSION['email']=$email;
        
        header("Location:home.php");
    }


  else{
    echo"<script language=\"javascript\">";
    echo"alert('This field must be unique')";
    echo"</script>";


  }}
?>