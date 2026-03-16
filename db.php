<?php

$conn = mysqli_connect("localhost", "root", "", "labexam2");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>