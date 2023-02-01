<!DOCTYPE html>
<head>

    <script src="../js/signup-page.js"></script>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    <main>
        <title>Sign Up Page</title>

        <h1>Create Account (HTML folder)</h1>
        <form id="createdCredentials">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname"><br>
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

</body>