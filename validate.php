<?php
session_start();

$connection = mysqli_connect("localhost","root","","realmilk");

$username = $_POST['username'];
$password = $_POST['password'];

if(isset($_POST["username"]) && isset($_POST["password"])){
        $sql_statement = "SELECT * FROM auth WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."' ";

        $result = $connection->query($sql_statement);

        if($result->num_rows > 0){
                 $_SESSION["username"] = $username;
                 $_SESSION["password"]=$password;
                 echo 'success';
                
        }
        else{
                echo 'No';
        }
        
}
?>