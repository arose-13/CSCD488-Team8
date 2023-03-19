<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    
    <div class="dashboard-grid" id="account-info">
        <h2>Change User Email</h2><br>
        <form id="login" action="changeEmail.php" method="post">
            <label for="newEmail">New email: </label><br>
            <input type="text" name="newEmail"><br>
            <label for="password">Enter Password: </label><br>
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
        $oldEmail = $_SESSION['email'];

        if($_POST["submit"] != null && $_POST["password"] != null && $_POST["newEmail"] != NULL) {
                echo "okay";
                $newEmail = $_POST["newEmail"];
                $password = $_POST["password"];
                $result = changeUserEmail($oldEmail, $newEmail, $password); 
                echo $result; 
                header('Location: logout.php');
        } else {
            return "Please enter in all fields";
        }
    ?>

</body>

<?php include 'components/main-footer.html'; ?>
