<?php

    //connects to local database
    $conn = mysqli_connect("localhost", "root", "root");

    //ensures table students exist
    $sql = "CREATE DATABASE IF NOT EXISTS students";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>