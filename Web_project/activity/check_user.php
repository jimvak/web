<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "activity"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$uname = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);



if ($uname != "" && $password != ""){

    $sql_query = "select count(*) as cntUser from user where username='".$uname."' and password='".$password."'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if($count > 0){
		
	//sql erotima to opoio epistrefei to id tou xristi	
	$sql_query2 = "select id from user where username='".$uname."' and password='".$password."'";
    $result2 = mysqli_query($con,$sql_query2);
    $row2 = mysqli_fetch_array($result2);
		
		//orizoume mia metavliti typou session i opoia exei to onoma connected stin opoia vazoume
		
// tin timi 1 gia na theorisoume oti o xristis einai sindedemenos
		$_SESSION["connected"] = 1;
		
		
		//epipleon session metavliti gia na kratame kai to id tou xristi
		
		$_SESSION["user_id"] = $row2["id"];
        
        echo 1;
    }else{
        echo 0;
    }

}