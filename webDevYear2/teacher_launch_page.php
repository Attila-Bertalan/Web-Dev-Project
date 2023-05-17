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
        $conn = mysqli_connect("localhost", "root", "root", "acetraining");
    
        session_start();
        $_SESSION['loginFirstname'];
        $_SESSION["loginLastname"];

        $firstname = $_SESSION['loginFirstname']; 
        $lastname = $_SESSION["loginLastname"] ;
    
        $name=$firstname." ".$lastname;
        $sql="SELECT course_name FROM courses";
        $classes=mysqli_query($conn,$sql);
        $class_length=count($classes);
        $sql="SELECT ID FROM enrollments WHERE authorised='0'";
        $result=mysqli_query($conn,$sql);
        while ($ids = mysqli_fetch_assoc($result)) {
            $id[]=$ids
        }
        $idLength=count($id)
        $students=array();
        for ($i=0;$i<$idLength;$i++) {
            $sql="SELECT firstname FROM users WHERE ID = '$id'";
            $studentFirstname=mysqli_query($conn,$sql);
            $sql="SELECT lastname FROM users WHERE ID = '$id'";
            $studentLastname=mysqli_query($conn,$sql);
            array_push($students,$studentFirstname." ".$studentLastname);
        }
    ?>
    <div class = "hero">
        <nav>
            <img src="images/menu.png" class ="menu-img" width="50" height="50" onclick="openClasses()">
            <img src="images/logo.png" class ="logo" width="50" height="50">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="register.html">Register</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
                <li>
                    <a href="teacher_launch_page.php">
                        <?php
                            echo "<p>$name<img class='a' src='images/profileIcon.png' width='20' height='20'></p>";
                        ?>
                    </a>
                </li>
                
            </ul>
        </nav>
    <?php
        echo "<h1>Welcome Back $name</h1>";
    ?>
    </div>

    <button class="open-button" onclick="openForm()"><img class="b" src="images/NotificationBell.png" width="50" height="50"></button>

    <div class="chat-popup" id="notifications">
    <form  class="form-container">
            <h3>Notifications:<button type="button" class="close" onclick="closeForm()"><img class="c" src="images/Grey_close_x.svg.png" width="10" height="10"></button></h3>
        
            <?php
                for ($i = 0; $i<$students_length; $i++) {
                    echo "
                        <div class='notif' id='$i'>
                            <img class='profile' src='images/profileIcon.png' alt='Avatar' style='width:100%'>
                            <button class='btn' onclick='accept($i)'><img src='images/tick.png'></button>
                            <button class='btn' onclick='reject($i)'><img src='images/cross.png'></button>
                            <p>$students[$i]</p>
                        </div>";
                }
            ?>
    </form>
    </div>

    <div class="class-popup" id="classes">
        <form class="class-container">
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
        function openForm() {
            document.getElementById("notifications").style.display = "block";
            event.preventDefault();
        }

        function closeForm() {
            document.getElementById("notifications").style.display = "none";
            event.preventDefault();
        }

        function openClasses() {
            document.getElementById("classes").style.display = "block";
            event.preventDefault();
        }
        
        function closeClasses() {
            document.getElementById("classes").style.display = "none";
            event.preventDefault();
        }

        function accept(num) {
            <?php
                $sql="UPDATE users SET authorised = '1' WHERE ID = $id[$i]"; 
                mysqli_query($conn,$sql)
            ?>
            document.getElementById(num).style.display = "none";
            event.preventDefault();
        }

        function reject(num) {
            <?php
                $sql="UPDATE users SET authorised = '0' WHERE ID='$id[$i]']"; 
                mysqli_query($conn,$sql)
            ?>
            document.getElementById(num).style.display = "none";
            event.preventDefault();
        }
    </script>
</body>

</html>
