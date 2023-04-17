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
$_SESSION['loginFirstname'];
$_SESSION["loginLastname"];

$firstname = $_SESSION['loginFirstname']; 
$lastname = $_SESSION["loginLastname"] ;
include "FilesManaging.php";


?>
<body>
    <div class = "hero">
        <nav>
            <img src="images/menu.png" class ="menu-img" width="50" height="50">
            <img src="images/logo.png" class ="logo" width="75" height="65">
            <ul>
                <li>
                
                <p><?php echo 'Welcome back '.$firstname .' '. $lastname.' !' ?> &nbsp; <img src="images/avatar1.png" id="Avatar" style="width: 4%"></p>
                </li>
                <li>
                    <a href="LogMeOut.php">Logout</a>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="about.php">About</a>
                </li>

            </ul>
        </nav>

        <div class="StudentLinks">

            <a href="StudentPage.php" class="StudentButton">Home</a>

            <a href="Reading.php" class="StudentButton">Reading</a>
 
            <a href="Quizzes.php" class="StudentButton">Quizzes</a>


        </div>

        <div>
        <table>
            <thead>
                <th>ID</th>
                <th>Filename</th>
                <th>size (in mb)</th>
                <th>Downloads</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                <td><?php echo $file['ID']; ?></td>
                <td><?php echo $file['name']; ?></td>
                <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                <td><?php echo $file['downloads']; ?></td>
                <td><a href="StudentResources.php?ID=<?php echo $file['ID'] ?>">Download</a></td>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
        </div>
        
    </div>
    
</body>

</html>
