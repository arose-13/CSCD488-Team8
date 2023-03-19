<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    
    <div class="dashboard-grid" id="account-info">
        <h2>Change Username</h2><br>
        <form id="login" action="changeUsername.php" method="post">
            <label for="newUsername">New username: </label><br>
            <input type="text" name="newUsername"><br>
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
        $email = $_SESSION['email'];
       
        if($_POST["submit"] != null && $_POST["password"] != null && $_POST["newUsername"] != NULL) {
                $newUsername = $_POST["newUsername"];
                $password = $_POST["password"];
                if(! preg_match('/^\w{5,}$/', $newUsername)) {
                    echo "Please enter alpha numberic username!<br>";
                } else {
                    $result = changeUsername($email, $newUsername, $password);
                    echo $result; 
                    $_SESSION["username"] = $newUsername;
                    header('Location: dashboard.php');
                }

        } else {
            return "Please enter in all fields";
        }
    ?>

</body>

<?php include 'components/main-footer.html'; ?>
