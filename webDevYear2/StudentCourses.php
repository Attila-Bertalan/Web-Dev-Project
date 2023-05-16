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
//session variables
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
 
            <a href="StudentQuiz.php" class="StudentButton">Quizzes</a>

            <a href="StudentPage.php" class="StudentButton">Student Home</a>


        </div>

        <div class="Enroll-Courses">
        <div class="Enroll-Courses">
            <?php
            // connect to the database
            $conn = mysqli_connect("localhost", "root", "root", "acetraining");

            // get the courses from the database
            $sql = "SELECT * FROM courses";
            $result = mysqli_query($conn, $sql);

            // display the courses in a form
            echo '<form method="post">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p>' . $row['course_ID'] . '</p>';
                echo '<p>' . $row['course_name'] . '</p>';
                echo '<input type="radio" name="course_id" value="' . $row['course_ID'] . '">';
                echo '<br>';
            }
            echo '<input type="submit" name="submit" value="Submit">';
            echo '</form>';

            if (isset($_POST['submit'])) {
                if (isset($_POST['course_id'])) {
                    $course_ID = $_POST['course_id'];
                    $user_ID = $_SESSION['loginID'];

                    $status = 'pending';

                    // save the enrollment request to the database
                    $stmt = $conn->prepare('INSERT INTO enrollments(course_ID, user_ID, status) VALUES(?,?,?)');
                    $stmt->bind_param("iis", $course_ID, $user_ID, $status);
                    
                    //check for error
                    if ($stmt->execute()) {
                        echo "Enrollment request submitted successfully!";
                    } else {
                        echo "Error submitting enrollment request: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Please select a course.";
                }
            }
            ?>
        </div>

        </div>
        <?php include "importFiles/studentFooter.php" ?>

    </div>
    
</body>

</html>