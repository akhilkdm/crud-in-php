<?php 
$host = "localhost";
$user = "root";
$pass = "";
$database = "ManageUser";

$connection = mysqli_connect($host, $user, $pass, $database);

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
  
    $query ="DELETE FROM users WHERE No='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:index.php");

    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>