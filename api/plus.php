<?php
session_start();

$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$z = $x + $y;
$user = $_SESSION["user"];

include(getenv("MYAPP_CONFIG"));

// $conn = mysqli_connect("localhost","root","","calc");
$conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
// $sql = "INSERT INTO log(Number1,Number2,Result,UserID) VALUES($x,$y,$z,'anonymus')";
$sql = "INSERT INTO log(Number1,Number2,Result,UserID) VALUES($x,$y,$z,'$user')";
mysqli_query($conn,$sql);
// echo(mysqli_error($conn));
mysqli_close($conn);
echo($z);