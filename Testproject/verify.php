<?php
if( isset($_POST['email']) and isset($_POST['password']) ) {
//Database connection
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="insert-php-ajax-jquery"; 
$conn=mysqli_connect( $dbhost, $dbuser, $dbpass, $db ) or die("Could not connect: " .mysqli_error($conn) );
 		$email=$_POST['email'];
		$password=$_POST['password'];
		$ret=mysqli_query( $conn, "SELECT * FROM student WHERE email='$email' AND password='$password'") or die("Could not execute query: " .mysqli_error($conn));
		$row = mysqli_fetch_assoc($ret);
		if(!$row) {
			 echo "Invalid Email ID or password !!! ";
                         header( "refresh:2;url=login.html" );
		}
		else {
			header("location:details.html");
                        } 
                         exit(); 
}
?>