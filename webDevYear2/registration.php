<?php 

    $firstname = $_POST ['firstname']  ;
    $lastname = $_POST ['lastname'];
    $pass =$_POST ['password'] ;
    //$gender = $_POST ['gender'];
    $email = $_POST ['email'];
    //$phone = $_POST ['phone'];

    $conn = mysqli_connect("localhost","root","root","acetraining");
    
    if(mysqli_connect_errno()){
        echo"failed to connect to mysql: " . mysqli_connect_error();

    }else{
        

        $stmt = $conn -> prepare('INSERT INTO users(firstname, lastname, pass, email) VALUES(?,?,?,?)');
        $stmt -> bind_param("ssss", $firstname,$lastname,$pass,$email);
        
        $stmt ->execute();
        header("refresh:5; url=index.php");
        echo"reg success, you will be redirected in 5 seconds.";
        $stmt ->close();
        $conn ->close();
        

    }



    
?>