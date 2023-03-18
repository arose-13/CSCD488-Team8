<?php

// All necessary functions for back-end functionality

function dbConnect() {
    $conn = mysqli_connect("localhost", "root", "")
        or die ("Could not connect to the server " . mysqli_error($conn));

    mysqli_select_db($conn, "budgetappuser")
        or die ("Could not open the database: " . mysqli_error($conn));

    return $conn;
}

function createUser($username, $email, $hash) {
    if ($username == NULL || $email == NULL || $hash == NULL
        || $username == "" || $email == "" || $hash == "")
        return "Input was invalid.";

    $conn = dbConnect();

<<<<<<< HEAD
    if (!userExists($email)) { 
        $currDate = date("m-d-y");
        $monthDatas = [];
=======
    if (!userExists($email)) {
        $currDate = date("Y-m-d");
>>>>>>> 383b0fd4a5c61b4ade1b39d07ddc0d92ef956ac7

        $query = "INSERT INTO appusertable
                    (`Id`, `userName`, `password`, `email`, `userCreationDate`, `accountActivated`, `userRole`, 
                    `m01`, `m02`, `m03`, `m04`, `m05`, `m06`, `m07`, `m08`, `m09`, `m10`, `m11`, `m12`)
                    VALUES
                    (NULL, '" . $username . "', '" . $hash . "', '" . $email . "', '" . $currDate . "',
                     '1', 'USER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";

        $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to create a new user.");

        return "Success";
    }
    else
        return "User already exists.";

    mysqli_close($conn);
}

function login($email, $hash) {
    if ($email == NULL || $hash == NULL
        || $email == "" || $hash == "")
        return "Input was invalid.";

    if (userExists($email)) {            
        $conn = dbConnect();
            
        $query = "SELECT * from appusertable where email = '" . $email . "' AND password = '" . $hash . "';";
        $result = mysqli_query($conn, $query)
            or die ("Could not execute the query in the login method.");

        mysqli_close($conn);

        if (mysqli_num_rows($result) != 1)
            return "Incorrect password.";
        else
            return "Success";
    }
    else
        return "User doesn't exist!";
}

function getMonthData($email) {
    if ($email == NULL)
        return "Input was null.";

    $conn = dbConnect();

    $month = date('m');
    
    $query = "SELECT m" . $month . " FROM appusertable WHERE email = '" . $email . "';";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to get the months data.");

    mysqli_close($conn);

    if ($result)
        return mysqli_fetch_array($result)[0];
    else
        return "The result of the query to get the month's data was null!";
}

function updateMonthData($email, $newMonthData) {
    if ($email == NULL || $newMonthData == NULL)
        return "Input was null.";

    $conn = dbConnect();

    $month = date('m');
    
    $query = "UPDATE appusertable SET m" . $month . " = '" . $newMonthData . "' WHERE email = '" . $email . "';";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to get the months data.");

    mysqli_close($conn);

    if ($result)
        return $result;
    else
        return "The result of the query to get the month's data was null!";
}

function changeUserEmail($oldEmail, $newEmail) {
    if ($oldEmail == NULL || $newEmail == NULL)
        return "Input was null.";

    $conn = dbConnect();

    $query = "UPDATE appusertable SET email = " . $newEmail . " WHERE email = " . $oldEmail . ";";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to update the user's email.");

    return "Success";
}

function changeUserPassword($email, $hash) {
    if ($email == NULL || $hash == NULL)
        return "Input was null.";

    $conn = dbConnect();

    $query = "UPDATE appusertable SET password = " . $hash . " WHERE email = " . $email . ";";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to update the user's email.");

    return "Success";
}

function userExists($email) {
    if ($email == NULL || $email == "")
        return "Input was invalid.";

    $conn = dbConnect();

<<<<<<< HEAD
    $query = "SELECT * FROM 'appusertable' WHERE 'email' = " . $email . ";"; 
=======
    $query = "SELECT * FROM appusertable WHERE email = '" . $email . "';";
>>>>>>> 383b0fd4a5c61b4ade1b39d07ddc0d92ef956ac7
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query that checks for a user's existance.");

    mysqli_close($conn);
    
    if (mysqli_num_rows($result) != 1)
        return false;
    return true;
}

function deleteUser($email) {
    if ($email == NULL || $email == "")
        return "Input was invalid.";

    if (userExists($email)) {
        $conn = dbConnect();

        $query = "DELETE FROM appusertable WHERE email = '" . $email . "';";
        $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to delete a user.");

        mysqli_close($conn);

        if ($result != 1)
            return "Something went wrong with the query.";
        return "Success";
    }
    else
        return "User doesn't exist!";
}

?>