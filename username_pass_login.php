<?php
session_start();
$_SESSION = array();
?>
<html>
<body>

 <?php
 
				$username_chk=$_POST["username_chk"];
				$pass_chk= $_POST["pass_chk"];
				
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_sugg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$hash_pwd=md5($pass_chk);
//echo $username_chk."<br>".$hash_pwd;

$sql_user = "select * from user_login where Email='$username_chk' and Set_pwd='$hash_pwd'";
$result1 = $conn->query($sql_user);
$sql_com = "select * from company_login where C_Email='$username_chk' and C_Setpwd='$hash_pwd'";
$result2 = $conn->query($sql_com);



if ($result1->num_rows > 0){
    // output data of each row
	while($row = $result1->fetch_assoc())
	{
		//$U_id=$row['U_id'];
		//echo "<br>".$U_id;
		$_SESSION['Name']=$row['Name'];
		//echo "here it is".$_SESSION['Name']."yes this";
		$_SESSION['logged_in_user'] = "true";
			
		$words = explode(" ",  $_SESSION["Name"]);
		$res_name = "";

		foreach ($words as $w) {
		  $res_name .= $w[0];
		  $res_name .= " ";
		}
		$res_name = strtoupper($res_name);
		$_SESSION['res_name']=$res_name;

		header("Location: http://localhost/job_suggestion_website/jobbee_jobs.php");
	}	
     
}
else if ($result2->num_rows > 0){
    // output data of each row
    while($row = $result2->fetch_assoc())
	{
        //$U_id=$row['U_id'];
		//echo "<br>".$U_id;
		$_SESSION['Name']=$row['C_Ename'];
		$_SESSION['logged_in_com'] = "true";
		
		$words = explode(" ",  $_SESSION["Name"]);
		$res_name = "";

		foreach ($words as $w) {
		  $res_name .= $w[0];
		  $res_name .= " ";
		}
		$res_name = strtoupper($res_name);
		$_SESSION['res_name']=$res_name;

		header("Location: http://localhost/job_suggestion_website/jobbee_jobs.php"); 
				
	}
} 

 else {
    //echo "0 results";
	//$_SESSION['Name']=$row['C_Ename'];
	$_SESSION['message_login'] = '*Incorrect username or password';
	
	header("Location: http://localhost/job_suggestion_website/jobbee_home.php"); 
}



?>



			


</body>
</html>