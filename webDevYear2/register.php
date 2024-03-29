<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer src="registerScript.js"></script>
    <title>Registration</title>
</head>

<body>

    <?php
        include ("navRegister.php")
    ?>

    <div class = "hero">
        <nav>
            <img src="images/menu.png" class ="menu-img" width="50" height="50">
            <img src="images/logo.png" class ="logo" width="50" height="50">
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
            </ul>
        </nav>
    </div>

    <form id="form" action="/" method="get">
        <div>
            <div class="input-control">
            <label for="First">First Name:</label>
            <input id="First" name="First" type="text">
            </div>
        </div>

        <div>
            <div class="input-control">
            <label for="Last">Last Name:</label>
            <input id="Last" name="Last" type="text">
            </div>
        </div>

        <div>
            <div class="input-control">
            <label for="Password">Password:</label>
            <input id="Password" name="Password" type="password">
            </div>
        </div>

        <div>
            <div class="input-control">
            <label for="Gender">Gender:</label>
            <input type="radio" id="Gender">Male
            <input type="radio" id="Gender">Female
            </div>
        </div>

        <div>
            <div class="input-control">
            <label for="Email">Email:</label>
            <input id="Email" name="Email" type="email" placeholder="example@email.com">
            </div>
        </div>

        <div>
            <div class="input-control">
            <label for="Phone">Phone Number:</label>
            <div class="phoneNumberInput">
                <select>
                <option>+44</option>
                <option>+971</option>
                <option>+40</option>
                <option>+35</option>
                </select>

                <input id="Phone" name="Phone" type="tel">
                </div>
             </div>
        </div>

        <button class="submitButton" type="submit">submit</button>

    </form>
    
</body>

</html>