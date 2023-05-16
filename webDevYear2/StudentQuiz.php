<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACE TRAINING </title>
    <link rel = "stylesheet" href="style.css">

</head>
<?php
session_start();
$firstname = $_SESSION['loginFirstname']; 
$lastname = $_SESSION["loginLastname"] ;
$user_ID = $_SESSION['loginID'];



?>
<body>
    <div class = "hero">
        <?php include "importFiles/studentNav.php" ?>


        <div class="StudentLinks">

            <a href="StudentResources.php" class="StudentButton">Resources</a>

            <a href="StudentReading.php" class="StudentButton">Reading</a>
 
            <a href="StudentPage.php" class="StudentButton">Student Home</a>
            
            <a href="StudentCourses.php" class="StudentButton">Courses</a>



        </div>

       

        
        <?php
        
            // connect to the database
            $conn = mysqli_connect("localhost", "root", "root", "acetraining");

            // get the quiz questions from the database
            $sql = "SELECT * FROM quiz";
            $result = mysqli_query($conn, $sql);

            // display the quiz questions in a form
            echo '<form method="post">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p>' . $row['question'] . '</p>';
                echo '<input type="radio" name="answer' . $row['quiz_id'] . '" value="1">' . $row['option1'] . '<br>';
                echo '<input type="radio" name="answer' . $row['quiz_id'] . '" value="2">' . $row['option2'] . '<br>';
                echo '<input type="radio" name="answer' . $row['quiz_id'] . '" value="3">' . $row['option3'] . '<br>';
                echo '<input type="radio" name="answer' . $row['quiz_id'] . '" value="4">' . $row['option4'] . '<br>';
            }
            echo '<input type="submit" name="submit" value="Submit">';
            echo '</form>';

            // process the quiz form
            if (isset($_POST['submit'])) {
                $score = 0;
                mysqli_data_seek($result, 0); // this resets the pointer back to 0, so that way when comparing answers, the pointer goes to 0
                while ($row = mysqli_fetch_assoc($result)) {
                    $answer = $_POST['answer' . $row['quiz_id']];
                    if ($answer == $row['answer']) {
                        $score++;
                    }
                }

                // save the user's score to the database

                $stmt = $conn -> prepare('INSERT INTO scores(user_ID, score) VALUES(?,?)');
                $stmt -> bind_param("ii", $user_ID, $score);
                $stmt -> execute();
                $stmt ->close();

                // display the user's score
                echo 'Your score is ' . $score;
            }
        ?>
         <?php include "importFiles/studentFooter.php"?>
    </div>
    
</body>

</html>