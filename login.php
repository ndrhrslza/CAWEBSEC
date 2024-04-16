<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {

    //retrieve from data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //Database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "auth";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    }

    //validate login authentication
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);

    if($result->num_rows == 1) {
        header("Location: userdetails.html");
        exit(); //login success
    } else {
        exit(); //login failed
    }

    $conn->close();
}

?>