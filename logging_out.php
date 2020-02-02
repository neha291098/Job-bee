<?php   
session_start();
$_SESSION = array();
?>

<html>
<body>

<?php 
//echo "yes you got here"; //to ensure you are using same session
session_destroy(); //destroy the session
header("Location:http://localhost/jobbee_home.php"); //to redirect back to "index.php" after logging out

?>
<!--<a href="http://localhost/jobbee_home.php">go back to home</a>-->
</body>
</html>