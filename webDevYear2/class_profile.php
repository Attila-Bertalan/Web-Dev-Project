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
        $sql="SELECT name FROM classes";//not sure this right but not sure where classes are being stored database wise
        $classes=mysqli_query($conn,$sql);
        $class_length=count($classes);
        $sql="SELECT firstname FROM users WHERE class='$class'";//again not sure this is right but you get the general gist
        $studentFirstnames=mysqli_query($conn,$sql);
        $sql="SELECT lastname FROM users WHERE class='$class'";
        $studentLastnames=mysqli_query($conn,$sql);
        $students_length=count($studentFirstnames);
        $students=array();
        for ($i=0;$i<$students_length;$i++) {
            array_push($students,$studentFirstnames[$i]." ".$studentLastnames[$i]);
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
    <div class="student_list">
        <?php
        for ($i = 0; $i<$students_length; $i++) {
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
                    <a href='Class_Profile.php?class=$classes[$i]'>
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

</script>
</body>
</html>
