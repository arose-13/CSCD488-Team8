<!DOCTYPE html>
<head>
    <!-- <script src="js/loginpage.js"></script> -->
    <title>Login Page</title>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>
</head>

<body>

    <?php include 'components/main-header.html'; ?>

    <main>
        <h1>Login Page</h1>

        <h2>Please enter in email and password below</h2>
        <form id="login" action="login.php" method="post">
            <label for="uname">Username: </label><br>
            <input type="text" id="uname" name="uname"><br>
            <label for="email">Email Address: </label><br>
            <input type="text" id="email" name="email"><br>
            <label for="password">Password: </label><br>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="Login" value="press to login" id="login-form-submit"><br><br>
            <button type="button" id="forgotPassword">Forgot password?</button>
        </form>
        <br><br>
        <button type="button" id="createAccount">Don't Have an Account?</button>
    </main>
    

    <?php include 'components/main-footer.html';?>

</body>
</html>
<?php include "backend/functions.php";

        if($_POST["email"] != null && $_POST["password"] != null && $_POST["uname"] != null) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $uName = $_POST["uname"];

            $result = login($email, $password);
           
            if($result != "Success") {
                echo $result;
                echo "Error signing in";
            } else {
                header('location:dashboard.php');
            }
        }

        

?>