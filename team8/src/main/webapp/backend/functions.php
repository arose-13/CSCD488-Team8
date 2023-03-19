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

    if (!userExists($email)) {
        $currDate = date("Y-m-d");

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

function login($email, $password) {
    if ($email == NULL || $password == NULL
        || $email == "" || $password == "")
        return "Input was invalid.";

    if (userExists($email)) {            
        $conn = dbConnect();
        $hash = getHash($email); 
        while($row = mysqli_fetch_array($hash)) {   
            $hashString = $row['password'];
        }        
        if(password_verify($password, $hashString)) { 
            echo "Password is correct";
            $query = "SELECT * from appusertable where email = '" . $email . "';";
            $result = mysqli_query($conn, $query)
                or die ("Could not execute the query in the login method.");

            mysqli_close($conn);

            if (mysqli_num_rows($result) != 1)
                return "Incorrect password.";
            else
                return "Success";
        }
            
        // $query = "SELECT * from appusertable where email = '" . $email . "';";
        // $result = mysqli_query($conn, $query)
        //     or die ("Could not execute the query in the login method.");

        // mysqli_close($conn);

        // if (mysqli_num_rows($result) != 1)
        //     return "Incorrect password.";
        // else
        //     return "Success";
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

function changeUserEmail($oldEmail, $newEmail, $password) {
    if ($oldEmail == NULL || $newEmail == NULL || $password == NULL)
        return "Input was null.";

    $conn = dbConnect();

    $hash = getHash($oldEmail);

    while($row = mysqli_fetch_array($hash)) {   
        $hashString = $row['password'];
    } 
    if(password_verify($password, $hashString)) { 
        $query = "UPDATE appusertable SET email = '" . $newEmail . "' WHERE email = '" . $oldEmail . "';";
        $result = mysqli_query($conn, $query)
                or die ("Could not execute the query to update the user's email.");

        return "Success";
    }
    else {
        return "Error, wrong password";
    }
}

function changeUserPassword($email, $password, $newPassword) {
    if ($email == NULL || $newPassword ==  NULL || $password == NULL)
        return "Input was null.";

    $conn = dbConnect();
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $oldHash = getHash($email);
    while($row = mysqli_fetch_array($oldHash)) {   
        $oldHashString = $row['password'];
    }        
    if(password_verify($password, $oldHashString)) { 
        $query = "UPDATE appusertable SET password = '" . $newPasswordHash . "' WHERE email = '" . $email . "';";
        $result = mysqli_query($conn, $query)
                or die ("Could not execute the query to update the user's email.");

        return "Updating password to $newPassword";
    } else {
        return "Error, incorrect password";
    }
}

function changeUsername($email, $newUserName, $password) {
    if ($email == NULL || $newUserName == NULL || $password == NULL)
        return "Input was null.";
    $conn = dbConnect();
    $hash = getHash($email);
    while($row = mysqli_fetch_array($hash)) {   
        $hashString = $row['password'];
    }       
    echo $hashString; 
    if(password_verify($password, $hashString)) { 
        $query = "UPDATE appusertable SET userName = '" . $newUserName . "' WHERE email = '" . $email . "';";
        $result = mysqli_query($conn, $query)
                or die ("Could not execute the query to update the user's email.");

        return "Updated username";
    } else {
        return "Incorrect password";
    }
}

function userExists($email) {
    if ($email == NULL || $email == "")
        return "Input was invalid.";

    $conn = dbConnect();

    $query = "SELECT * FROM appusertable WHERE email = '" . $email . "';";
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

function getHash($email) {
    if($email == NULL)
        return "Input is invalid";
    $conn = dbConnect();
    $query = "SELECT password FROM appusertable WHERE email = '" . $email . "';";
    $result = mysqli_query($conn, $query)
        or die ("Could not execute the query that retrieves the user's hashed password.");

    mysqli_close($conn);

    if(mysqli_num_rows($result) != 1)
        return "Error retrieving hashed password";
    else {
        // while($row = mysqli_fetch_array($hash)) {   
        //     $resultString = $row['password'];
        // } 
        return $result;
    }
}
?>