<!DOCTYPE html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="background"></div>
    <div class="login">

        <div class="image">
            <img src="book2.png"/>
        </div>

        <div class="library">
            <h1><span class="header">Library</span><br> Management System</h1>
        </div>

        <p id="form_title"><span id="span1">Student</span> <span id="span2"> Login</span></p>

        <form action="logintest.php" id="f1" method="post"> <!-- student login -->
            <input type="email" placeholder="Enter email user form" name="email"><br>
            <input type="password" placeholder="Enter password" name="pword" id="pword"><br>

            <input type="hidden" name="sl" value="1">
            <input type="checkbox" name="c1" id="c1">
            <label for="c1">Show password</label><br>

            <input type="submit" value="Login">
            <input type="reset" id="reset1">
        </form>

        <form action="logintest.php" id="f2" method="post"> <!-- admin login -->
            <input type="email" placeholder="Enter email admin form" name="email" ><br>
            <input type="password" placeholder="Enter password" name="pword" id="pword2"><br>

            <input type="hidden" name="al" value="1">
            <input type="checkbox" name="c2" id="c2">
            <label for="c2">Show password</label><br>

            <input type="submit" value="Login">
            <input type="reset" >
        </form>

    </div>
    <button id="button1" onclick="toggleforms()">Admin Login</button>

    <script src="login2.js"></script>
</body>


</html>