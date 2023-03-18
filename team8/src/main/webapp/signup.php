<!DOCTYPE html>
<head>

    <!-- <script src="../js/signup-page.js"></script> -->
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    <main>
        <title>Sign Up Page</title>

        <h1>Create Account (HTML folder)</h1>
        <form id="createdCredentials" action="signup.php" method="post">
            <label for="uname">Username:</label><br>
            <!-- <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last Name:</label><br> -->
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
    //using curl request-> might abandon
    // if(isset($_POST["fname"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    //     $name = $_POST["fname"];
    //     $pword = $_POST["password"];
    //     $email = $_POST["email"];

    //     //authentication email
    //     $authenticateEmail = curl_init("localhost:8080/team8-0.1/JavaEmail/auth/{$email}");
    //     curl_setopt($authenticateEmail, CURLOPT_POST, true);
    //     curl_setopt($authenticateEmail, CURLOPT_RETURNTRANSFER, true);
    //     $message = curl_exec($authenticateEmail);
    //     curl_close($authenticateEmail);
    //     // echo $name;
    //     // echo $pword;
    //     echo "my name is {$name}";
    //     $createUser = curl_init("localhost:8080/team8-0.1/user/newUser/{$uName}/{$email}/{$password}");
    //     curl_setopt($createUser, CURLOPT_POST, true); //making a post request
    //     curl_setopt($createUser, CURLOPT_RETURNTRANSFER, true); //store output in variable
    //     $result = curl_exec($createUser);
    //     curl_close($createUser);

    //     if ($result) {
    //         echo $result;
    //     } else {
    //         echo "nothing was returned";
    //     }
    // }
    if($_POST["email"] != null && $_POST["password"] != null && $_POST["uname"] != null && $_POST["reenterpassword"] != null) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $reenterpassword = $_POST["reenterpassword"];
        $uName = $_POST["uname"];
        // echo $email;
        // echo $password;
        // echo $uName;
        if($password != $reenterpassword) {
            echo "Passwords do not match!";
        } else {
            //password validation needed
            //email validation needed
            //username validation needed

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $newUser = createUser($uName, $email, $hash); //going wrong here

            if($newUser != "Success") {
                echo "Error creating user";
            }
            else { 
                echo "User successfully created";
            }
        }
    
    }
    

    ?>

</body>