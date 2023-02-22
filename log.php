<?php
session_start();
include_once 'includes/connection.php';
$data = json_decode(file_get_contents("php://input"));



$email     = $data->email;
$password = $data->password;
// $sql = "SELECT password FROM users WHERE email='$email'";
// $result = mysqli_query($con, $sql);
// $hash_pass = mysqli_fetch_assoc($result);
// $user = $hash_pass['password'];
// echo password_verify($password, $user);
// // if(password_verify($password,$user)){
// //     echo 1;
// // }else{
// //     echo mysqli_error($con);
// // }
$sql_stmt = $con->prepare("SELECT * FROM users WHERE email=? AND password=?");
$sql_stmt->bind_param("ss", $email, $password);
$sql_stmt->execute();
$result = $sql_stmt->get_result();
$user = $result->fetch_assoc();
if($user){
    echo 1;
    $_SESSION['userid'] = $user['id'];
    $_SESSION['firstName'] = $user['firstName'];
}else{
    echo 0;
}
$sql_stmt->close();
$con->close();

/*
$sql = "SELECT * FROM users WHERE email='$email' AND password = '$password'";
$result = mysqli_query($con, $sql);
if($result){
    echo $result;
}else{
    echo 0;
}*/