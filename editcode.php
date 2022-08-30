<?php 
$host = "localhost";
$user = "root";
$pass = "";
$database = "ManageUser";

$connection = mysqli_connect($host, $user, $pass, $database);

if(isset($_POST['updatedata']))
{
    $id = $_POST['update_id'];
    $firstname =$_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];


    echo $_POST['firstname'];

    $query ="UPDATE users SET firstname= '$firstname',lastname='$lastname', email='$email', address='$address', doj='$doj', salary='$salary' WHERE No='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){

        echo '<script> alert("Data Udated"); </script>';
        header("Location:index.php");

    }
    else
    {

        // header("Location:index.php");
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>