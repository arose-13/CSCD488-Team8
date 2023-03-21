<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/app-header.html'; ?>

    <?php 
        session_start();

        if (!isset($_SESSION['email']))
            header("Location: login.php");

        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
    ?>
    <div class="dash-banner">
        <span>Username: <?php echo $_SESSION["username"]?></span>
        <span>Email: <?php echo $_SESSION["email"]?></span>
    </div>

    <div>
        <a class="login-form-submit" href="changeEmail.php">Change Email</a><br> 
        <a class="login-form-submit" href="changeUsername.php">Change Username</a><br>
        <a class="login-form-submit" href="changePassword.php">Change Password</a><br>
    </div><br>

    <div class="dashboard-grid" id="account-info">
        <h2 class="hidden-form">Change User Information</h2><br>
        <form id="login" action="accountdetails.php" method="post">
            <label for="newEmail" class="hidden-form">New email: </label><br>
            <input type="text" name="newEmail" class="hidden-form"><br>
            <label for="newUsername" class="hidden-form">New username: </label><br>
            <input type="text" name="newUsername" class="hidden-form"><br>
            <label for="newPassword" class="hidden-form">New password: </label><br>
            <input type="text" name="newPassword" class="hidden-form"><br>
            <input type="submit" name="submit" value="submit" class="hidden-form" id="login-form-submit"><br><br>
        </form>
        <br><br>

    </div>

    <?php include 'backend/functions.php';

        if(isset($_POST["submit"])) {
            if($_POST["newEmail"] != null){
                $newEmail = $_POST["newEmail"];
                updateEmail($newEmail);
            }
            if($_POST["newUsername"] != null){
                $newUsername = $_POST["newUsername"];
                updateUsername($newUsername);
            }
            if($_POST["newPassword"] != null){
                $newPassword = $_POST["newPassword"];
                updatePassword($newPassword);
            }
        }

        function updateEmail($newEmail){ 
            $oldEmail = $_SESSION["email"];
            $result = changeUserEmail($oldEmail, $newEmail); 
            echo $result; 
        }
        function updatePassword($newPassword) {  
            $email = $_SESSION["email"];
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $result = changeUserPassword($email, $newHash);
            echo $result;
        }
        function updateUsername($newUsername) { 
            $email = $_SESSION["email"];
            $result = changeUsername($email, $newUsername);
            echo $result;
        } 
    ?>
    

    <?php include 'components/app-footer.html'; ?>

</body>