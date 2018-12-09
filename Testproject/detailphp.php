<?php
//Getting posted value
$dept = $_POST['dept'];
$aof = $_POST['aof'];
$gender = $_POST['radio'];
$address = $_POST['address'];
$rollno = $_POST['rollno'];
$hobby = $_POST['hobby'];
$country = $_POST['state'];
if(!empty($dept) || !empty($aof) || !empty($gender) || !empty($address) || !empty($rollno) || !empty($hobby) || !empty($country))
{
//DB connecion
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname= "insert-php-ajax-jquery";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
     $SELECT = "SELECT rollno From details Where rollno= ? Limit 1";
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("i", $rollno);
     $stmt->execute();
     $stmt->bind_result($rollno);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
      $stmt->close();

     $INSERT = "INSERT Into details (dept, aof, gender, address, rollno, hobby, country) values(?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssiss", $dept, $aof, $gender, $address, $rollno, $hobby, $country);
      $stmt->execute(); 

     $sql = "select * from details where rollno=$rollno";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    //create an php array to store JSON string

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
     $fp = fopen('empdata.json', 'w');//create a JSCON format file to store JSON string
    fwrite($fp, json_encode($emparray));//writing PHP array value to JSON file
    fclose($fp);
 
     $json=file_get_contents("empdata.json");//To get the value from JSON file
     $data=json_decode($json,true);//To decode the JSON File
 
       echo"  -------------------------------Details Entered By Users------------------------------------ ";          
        if (count($data)) 
          {
            // Open the table
            foreach ($data as $stand)
          {
           echo '<table border=4>';
           echo '<tr><td>';
           echo "Deparment : ";
           echo $stand["dept"];//To Get the array value dept of stand
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Area Of Interest : ";
           echo  $stand["aof"];
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Gender : ";
           echo $stand["gender"];
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Address : ";
           echo $stand["address"];
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Roll No : ";
           echo $stand["rollno"];
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Hobby : ";
           echo $stand["hobby"];
           echo '</td></tr>';

           echo '<tr><td>';
           echo "Country : ";
           echo $stand["country"];
           echo '</td></tr>';
           echo '</table>';
           echo "-----------------------------------------------------------------------";
            }
        }

       mysqli_close($conn);//Closing DB connection
     exit();
}
else
{
	header("location:login.html");
}
}
   
?>