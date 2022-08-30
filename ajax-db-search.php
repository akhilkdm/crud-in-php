<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "ManageUser";

$connection = mysqli_connect($host, $user, $pass, $database);


if (isset($_POST['term'])) {

    $s_values = $_POST['term'];

   
     
   $query = "SELECT * FROM users WHERE firstname LIKE '{$s_values}%' LIMIT 25";
  
    $result = mysqli_query($connection, $query);

 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res = $user['firstname'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>