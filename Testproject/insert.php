<?php
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile = $_POST['mobilenumber'];
if(!empty($fname) || !empty($lname) || !empty($email ) || !empty($password) || !empty($mobile))
{
//db connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname= "insert-php-ajax-jquery";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
 if (mysqli_connect_error()) 
   {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
  else 
  {  
    //select value to avoid register using same email

    $SELECT = "SELECT email From student Where email = ? Limit 1";
     $INSERT = "INSERT Into student (fname, lname, email, password, mobile) values(?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);//prepare statement to insert data to DB
      $stmt->bind_param("ssssi", $fname, $lname, $email, $password, $mobile);
      $stmt->execute();
      echo "New record inserted sucessfully";
       header("location:login.html");
     } 
      else 
      {
      echo "Someone Already Registered Using This Email ID !!!!!!";
     header( "refresh:2;url=register.html" );
      
     }

     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>