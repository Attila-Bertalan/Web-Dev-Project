<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACE TRAINING </title>
    <link rel = "stylesheet" href="style.css">

</head>

<body>
    <?php
        $class=$_GET['class'];
        $name=$_GET['name'];
        $conn = mysqli_connect("localhost", "root", "root", "acetraining");
        $sql="SELECT course_name FROM courses";
        $classed=mysqli_query($conn,$sql);
        $classes=array();
        while ($temp = mysqli_fetch_assoc($classed)) {
            array_push($classes,$temp['course_name']);
        }
        $class_length=count($classes);
        $sql="SELECT course_ID FROM courses WHERE course_name='$class'";
        $classId=mysqli_query($conn,$sql);
        $classIds=mysqli_fetch_assoc($classId);
        $sql="SELECT user_ID FROM enrollment WHERE course_ID='$classIds['course_ID']'";
        $result=mysqli_query($conn,$sql);
        $id=array();
        while ($ids = mysqli_fetch_assoc($result)) {
            array_push($id,$ids['user_ID']);
        }
        $idLength=count($id);
        $students=array();
        for ($i=0;$i<$idLength;$i++) {
            $sql="SELECT firstname FROM users WHERE ID='$id[$i]'";
            $studentFirstname=mysqli_query($conn,$sql);
            $sql="SELECT lastname FROM users WHERE ID='$id[$i]'";
            $studentLastname=mysqli_query($conn,$sql);
            $studentFirstnameResult=mysqli_fetch_assoc($studentFirstname);
            $studentLastnameResult=mysqli_fetch_assoc($studentLastname);
            $studentFullname=$studentFirstnameResult['firstname']." ".$studentLastnameResult['lastname'];
            array_push($students,$studentFullname);
        }
    
        $sql="SELECT user_ID FROM enrollment WHERE course_ID='$classId' AND status='pending'";
        $result=mysqli_query($conn,$sql);
        $enrollmentId=array();
        while ($ids = mysqli_fetch_assoc($result)) {
            array_push($enrollmetnId,$ids);
        }
        $enrollmetIdLength=count($id);
        $enrollmentStudents=array();
        for ($i=0;$i<$enrollmetIdLength;$i++) {
            $sql="SELECT firstname FROM users WHERE ID='$enrollmetnId[$i]'";
            $studentFirstname=mysqli_query($conn,$sql);
            $sql="SELECT lastname FROM users WHERE ID='$enrollmetnId[$i]'";
            $studentLastname=mysqli_query($conn,$sql);
            $studentFirstnameResult=mysqli_fetch_assoc($studentFirstname);
            $studentLastnameResult=mysqli_fetch_assoc($studentLastname);
            $studentFullname=$studentFirstnameResult('firstname')." ".$studentLastnameResult('lastname');
            array_push($enrollmentStudents,$studentFullname);
        }
    ?>
    <div class = "hero">
        <nav>
            <img src="images/menu.png" class ="menu-img" width="50" height="50" onclick="openClasses()">
            <img src="images/logo.png" class ="logo" width="75" height="65">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="login.html">Login</a>
                </li>
                <li>
                    <a href="register.html">Register</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
                <li>
                    <a href="teacher_launch_page.php">
                        <p>Mr. Boulton<img class="a" src="images/profileIcon.png" width="20" height="20"></p>
                    </a>
                </li>
            </ul>
        </nav>
        <?php
            echo "<h1>$class</h1>"
        ?>
    </div>
    <button class="open-button" onclick="openForm()"><img class="b" src="images/NotificationBell.png" width="50" height="50"></button>

    <div class="chat-popup" id="notifications">
    <form  class="form-container">
            <h3>Notifications:<button type="button" class="close" onclick="closeForm()"><img class="c" src="images/Grey_close_x.svg.png" width="10" height="10"></button></h3>
        
            <?php
                for ($i = 0; $i<$enrollmetIdLength; $i++) {
                    echo "
                        <div class='notif' id='$i'>
                            <img class='profile' src='images/profileIcon.png' alt='Avatar' style='width:100%'>
                            <button class='btn' onclick='accept($i)'><img src='images/tick.png'></button>
                            <button class='btn' onclick='reject($i)'><img src='images/cross.png'></button>
                            <p>$enrollmentStudents[$i]</p>
                        </div>";
                }
            ?>
    </form>
    </div>

    <div class="student_list">
        <?php
        for ($i = 0; $i<$idLength; $i++) {
            echo "
                <div class='student'>
                    <img src='images/profileIcon.png' alt='Avatar' style='width:100%'>
                    <p>$students[$i]</p>
                </div>";
            }
        ?>
    </div>
    <div class="send_files">
    <form action="FilesManaging.php" method="post" enctype="multipart/form-data" >
          <h3>Upload File</h3>
          <input type="file" name="myfile"> <br>
          <button type="submit" name="save">upload</button>
    </div>
    <div class="set_quiz"></div>
    <div class="class-popup" id="classes">
        <form action="/action_page.php" class="class-container">
            <h3>Classes:<button type="button" class="close" onclick="closeClasses()"><img class="c" src="images/Grey_close_x.svg.png" width="10" height="10"></button></h3>
            <?php
            for ($i = 0; $i<$class_length; $i++) {
                echo "
                    <a href='Class_Profile.php?class=$classes[$i]&name=$name'>
                        <button type='button' class='btn'>
                            <img src='images/profileIcon.png' alt='Avatar' style='width:100%'>
                            <p>$classes[$i]</p>
                        </button>
                    </a>";
            }   
            ?>
            </form>
    </div>
<script>
    function openClasses() {
            document.getElementById("classes").style.display = "block";
        }

    function closeClasses() {
        document.getElementById("classes").style.display = "none";
    }
    
    function openForm() {
        document.getElementById("notifications").style.display = "block";
        event.preventDefault();
    }

    function closeForm() {
        document.getElementById("notifications").style.display = "none";
        event.preventDefault();
    }
    
    function accept(num) {
         <?php
             $sql="UPDATE enrollments SET status = 'authorized' WHERE user_ID = $enrollmentId[$i]"; 
             mysqli_query($conn,$sql)
         ?>
         document.getElementById(num).style.display = "none";
         event.preventDefault();
    }

    function reject(num) {
         <?php
            $sql="UPDATE enrollments SET status = 'rejected' WHERE user_ID='$enrollmentId[$i]']"; 
            mysqli_query($conn,$sql)
         ?>
         document.getElementById(num).style.display = "none";
         event.preventDefault();
    }

</script>
</body>
</html>
