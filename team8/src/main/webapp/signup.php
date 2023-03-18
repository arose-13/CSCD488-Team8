<!DOCTYPE html>
<head>

    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    <main>
        <title>Sign Up Page</title>

        <h1>Create Account</h1>
        <form id="createdCredentials" action="signup.php" method="post">
            <label for="uname">Username:</label><br>
            <input type="text" id="uname" name="uname"><br>
            <label for="email">Email Address: </label><br>
            <input type="text" id="email" name="email"><br>
            <label for="password">Password: </label><br>
            <input type="text" id="password" name="password"><br>
            <label for="reenterpassword">Re-enter Password: </label><br>
            <input type="text" id="reenterpassword" name="reenterpassword"><br><br>
            <input type="submit" value="create account" id="createAccount"><br><br>
        </form>
    </main>


    <?php include 'components/main-footer.html' ?>

    <?php include "backend/functions.php";
    
    if($_POST["email"] != null && $_POST["password"] != null && $_POST["uname"] != null && $_POST["reenterpassword"] != null) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $reenterpassword = $_POST["reenterpassword"];
        $uName = $_POST["uname"];
        
        if($password != $reenterpassword) {
            echo "Passwords do not match!";
        } else {
            if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Please enter a correct email!<br>";
            }

            if(! preg_match('/^\w{5,}$/', $uName)) {
                echo "Please enter alpha numberic username!<br>";
            }
            if(! ctype_alnum($password)) {
                echo "Please enter a valid password: characters and digits only!";
            }
            else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $newUser = createUser($uName, $email, $hash); 

                if($newUser != "Success") {
                    echo $newUser;
                } 
                else { 
                    echo "User successfully created";
                    header('location:budget.php');
                }
            }

    
        }
    
    }
    

    ?>

</body>