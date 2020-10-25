<?php
session_start();
if(isset($_SESSION["email"])){

    echo "<p> welcome ".$_SESSION["email"];



}
else{
    header("Location:login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Myform">

<input type="submit" value="se deconnecter" name="submit" id="submit">

</form>
</body>
</html>


<?php

if(isset($_POST["submit"])){

session_destroy();
header("Location:login.php");
}

?>
