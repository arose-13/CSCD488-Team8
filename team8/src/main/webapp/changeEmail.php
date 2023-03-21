<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/app-header.html'; ?>

    
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

        if(isset($_POST["submit"]) && isset($_POST["password"]) && isset($_POST["newEmail"])) {
                $newEmail = $_POST["newEmail"];
                $password = $_POST["password"];
                if(! filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                    echo "Please enter a correct email!<br>";
                } else {
                    $result = changeUserEmail($oldEmail, $newEmail, $password); 
                    echo $result; 
                    $_SESSION["email"] = $newEmail;
                    header('Location: dashboard.php');
                }
        } else {
            return "Please enter in all fields";
        }
    ?>

</body>

<?php include 'components/app-footer.html'; ?>
