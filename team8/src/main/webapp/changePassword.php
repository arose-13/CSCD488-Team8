<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/app-header.html'; ?>

    
    <div class="dashboard-grid" id="account-info">
        <h2>Change Password</h2><br>
        <form id="login" action="changePassword.php" method="post">
            <label for="newPassword">New Password: </label><br>
            <input type="text" name="newPassword"><br>
            <label for="reenterNewPassword">Re-enter New Password: </label><br>
            <input type="text" name="reenterNewPassword"><br>
            <label for="password">Enter Old Password: </label><br>
            <input type="text" name="password"><br>
            <input type="submit" name="submit" value="submit" id="login-form-submit"><br><br>
        </form>
        <br><br>

    </div>
    <?php include 'backend/functions.php';
        session_start();

        if (!isset($_SESSION['email']))
            header("Location: login.php");

        $username = $_SESSION['username'];
        $email = $_SESSION['email'];

        if(isset($_POST["submit"]) && isset($_POST["password"]) && isset($_POST["reenterNewPassword"])) {
            if($_POST["newPassword"] == $_POST["reenterNewPassword"]) {
                $newPassword = $_POST["newPassword"];
                $password = $_POST["password"];
                if(! ctype_alnum($password)) {
                    echo "Invalid password!";
                } else {
                    $result = changeUserPassword($email, $password, $newPassword);
                    echo $result; 
                    $_SESSION["password"] = $newPassword;
                    header('Location: dashboard.php');
                }
            } else {
                echo "Passwords did not match!";
            }
        } else {
            return "Please enter in all fields";
        }
    ?>

</body>

<?php include 'components/app-footer.html'; ?>
